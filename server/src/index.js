
import express from 'express'
import axios from 'axios'

// import nodejs bindings to native tensorflow,
// not required, but will speed up things drastically (python required)
//import '@tensorflow/tfjs-node';

// implements nodejs wrappers for HTMLCanvasElement, HTMLImageElement, ImageData
import * as canvas from 'canvas';


import * as faceapi from 'face-api.js'

// patch nodejs environment, we need to provide an implementation of
// HTMLCanvasElement and HTMLImageElement, additionally an implementation
// of ImageData is required, in case you want to use the MTCNN
const { Canvas, Image, ImageData } = canvas
faceapi.env.monkeyPatch({ Canvas, Image, ImageData })

import path from 'path';
import { fileURLToPath } from 'url';

import dotenv from 'dotenv';
dotenv.config()

const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

console.log('hello', __dirname)

const API_URL = (process.env.STATUS == 'PROD') ? process.env.PROD_URL+'/api' :
                (process.env.STATUS == 'DEMO') ? process.env.DEMO_URL+'/api' :
                process.env.DEV_URL+'/api'

const PORT = process.env.PORT

axios.create({baseUrl: API_URL});

const MODEL_PATH = path.join(__dirname, '../weights')
const MODEL_URL = 'http://localhost:8000/weights'

const REFERENCE_IMAGE = 'http://localhost:8000/storage/criminals/1693633750.jpg'
const QUERY_IMAGE = 'http://localhost:8000/storage/bookings/1693812262.jpeg'
let faceMatcher

async function loadModels() {
    await faceapi.loadSsdMobilenetv1Model(MODEL_URL)
    await faceapi.loadFaceLandmarkModel(MODEL_URL)
    await faceapi.loadFaceRecognitionModel(MODEL_URL)
}

 // fetch first image of each class and compute their descriptors
 async function createBbtFaceMatcher(images) {

    console.log('start createBbtFaceMatcher',images)
    let imageSingle =  [images[0]]

    const labeledFaceDescriptors = await Promise.all(
        images.map(
            async function (item){
                const descriptors = []

                const referenceImage = await canvas.loadImage(item.photo_url)
                descriptors.push(await faceapi.computeFaceDescriptor(referenceImage));
                return new faceapi.LabeledFaceDescriptors(
                    'user_'+item.id,
                    descriptors
                  )
            }
        )
    )
    console.log('labeledFaceDescriptors',labeledFaceDescriptors)
    return new faceapi.FaceMatcher(labeledFaceDescriptors,0.6)

}
async function runFaceMatch(criminals, guests) {

    //console.log('criminals', criminals)
    //console.log('guests', guests)
    const guest = guests[0];
    const queryImageUrl = guest.photo_url;
    console.log(guest)

    //load all images in faceMatcher - train model with existing set of images
    console.log('faceMatcher.. preparing',faceMatcher)
    faceMatcher =  await createBbtFaceMatcher(criminals)
    console.log('faceMatcher.. training data loaded ',faceMatcher)

    console.log('preparing query image data')
    const queryImage = await canvas.loadImage(queryImageUrl)
    const queryImgFaceDescriptors = await faceapi.computeFaceDescriptor(queryImage)
    console.log('Query image descriptor computed',queryImgFaceDescriptors)

    // find best matching image if any - confidence 0.5
    const bestMatch = faceMatcher.findBestMatch(queryImgFaceDescriptors)
    const bestMatchUser = bestMatch.toString()

    // match NOT found
    if(bestMatchUser.includes('unkown')){

    }

    // match found
    if(bestMatchUser.includes('user_')){

        const matchArray = bestMatchUser.split(' ')
        console.log(matchArray)

        //get userid
        let bestMatchUserId = matchArray[0].replace('user_', '')

        //get accuracy
        let accuracy = parseFloat(matchArray[1].replace('(', '').replace(')',''))
        accuracy = (1 - accuracy) * 100

        console.log('bestMatch...'+bestMatch)
        console.log('accuracy...'+accuracy)
        console.log('bestMatchUserId...'+bestMatchUserId)

        //send result to API
        const payload = {
            booking_id : parseInt(guest.id),
            suspicious: 'yes',
            criminal_id: parseInt(bestMatchUserId),
            accuracy: accuracy,
        }
        console.log(payload)
        axios.post(API_URL+'/save-bg-check-results',payload).then((response) => {
            let data = response.data
                console.log('data',data)
                //return
        })
    }


}

const getGuests = (criminals, callback) => {

    // console.log('getGuests')
    // console.log('starting..')
    // console.log('criminals..', criminals)

    axios.get(API_URL+'/guests')
    .then((response) => {
        let guests = response.data

        // console.log('Total '+Object.keys(guests).length+' guests found!')
        // console.log(guests)

        const guest = guests[0];
        const queryImageUrl = guest.photo_url;

        fetch(queryImageUrl).then(response => {

            if (response.ok) {

                console.log('Image URL is valid');
                //proceed
                runFaceMatch(criminals, guests);

            } else {

                console.log('Image URL is invalid');
                //stop and send response
                axios.post(API_URL+'/save-bg-check-results',{
                    booking_id : parseInt(guest.id),
                    suspicious: 'no',
                    criminal_id: '',
                    accuracy: '',
                }).then((response) => {
                    let data = response.data
                    console.log('data',data)
                })
        }
      })



    })
    .catch((error) => {
        console.log(error);
    });
}

const getCriminals = (params, callback) => {

    // console.log('getCriminals')
    // console.log('starting..')

    axios.get(API_URL+'/criminals')
    .then((response) => {
        let criminals = response.data

        // console.log('Total '+Object.keys(criminals).length+' criminals found!')
        // console.log(criminals)

        callback(criminals);

    })
    .catch((error) => {
        console.log(error);
    });
}
async function run(){

    //load models
    console.log('Loading models...')
    await loadModels().then( () => {
        console.log('finished loading models..')
    })

    //get data
    console.log('Loading images from Dataset...')
    getCriminals( [], getGuests)

    // const referenceImage = await canvas.loadImage(REFERENCE_IMAGE)
    // console.log(referenceImage)
    // const resultsRef = await faceapi.computeFaceDescriptor(referenceImage);
    // console.log(resultsRef)
}

run()

const app = express()
app.use(express.json());
app.listen(PORT, () => {
    console.log("Server Listening on PORT:", PORT);
});


app.get('/', (req, res) => {
    run().then(()=>{
        res.send({'status':'Completed'});
    })

});
