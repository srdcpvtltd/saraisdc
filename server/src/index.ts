//"use strict";

import express, { Express, Request, Response } from 'express';
const axios = require('axios')
import dotenv from 'dotenv';
import { Image } from 'canvas';
import * as faceapiTs from 'face-api.js'
import drawDetection from 'face-api.js'
import { canvas, faceDetectionNet, faceDetectionOptions, saveFile } from './commons'
import { Callback, any } from '@tensorflow/tfjs-node';
dotenv.config()
import path from 'path';
import { loadImage } from 'canvas';
global.Blob = require('blob');


const app = express()
const PORT = (process.env.STATUS == 'production')
    ? process.env.PROD_PORT
    : process.env.DEV_PORT
app.use(express.json());

const API_URL = process.env.API_URL
axios.create({baseUrl: API_URL});


app.get('/', (req: Request, res: Response) => {
    res.send({'status':'Running'});
});

console.log('Hello world!')
console.log(__dirname)
const MODEL_URL = path.join(__dirname, '../weights')
const MODEL_URI = 'http://localhost:8000/weights'

let faceMatcher = null
const REFERENCE_IMAGE = 'http://localhost:8000/storage/criminals/1693633750.jpg'
const QUERY_IMAGE = 'http://localhost:8000/storage/bookings/1693812262.jpeg'
let criminals = {}
let guests = {}
const imagesPathCriminals = path.join(__dirname, '../../public/storage/criminals/')
console.log('imagesPathCriminals',imagesPathCriminals)

    // fetch first image of each class and compute their descriptors
    async function createBbtFaceMatcher(images:any) {

        console.log('images',images)
        let imagesNew =  [images[0]]

        // const maxAvailableImagesPerClass = 1
        // numImagesForTraining = Math.min(numImagesForTraining, maxAvailableImagesPerClass)

         const labeledFaceDescriptors = await Promise.all(
            imagesNew.map(
                async function (image:any) {
                    const descriptors: any = []

                    //get base 64 encoding
                    //create image html tag
                    //pass to faceapiTs

                    const img =  await canvas.loadImage(image.photo_url)
                    let myCanvas = canvas.createCanvas(200, 200)
                    myCanvas.getContext('2d').drawImage(img, 0, 0);
                    let canvasData = myCanvas.toDataURL();

                    let imageTag = new Image
                    imageTag.src = canvasData

                    await faceapiTs.computeFaceDescriptor(imageTag)
                    //console.log('image',image)
                    //console.log('descriptors',descriptors)

                    // const referenceImage = await canvas.loadImage(REFERENCE_IMAGE)
                    // console.log('referenceImage',referenceImage)


                    //load image from url
                    let img_url =  path.join(__dirname, './Prasad_Madhavi_0001.jpg')
                    //console.log(img_url)
                    //console.log(imagesPathCriminals+image.photo)

                    // const img =  await canvas.loadImage(img_url)

                    // let myCanvas = canvas.createCanvas(200, 200)
                    // myCanvas.getContext('2d').drawImage(img, 0, 0);
                    // let canvasData = myCanvas.toDataURL();

                    //const imageData =  get('https://www.google.com/images/branding/googlelogo/2x/googlelogo_light_color_272x92dp.png')


                    //const imageData = await faceapi.fetchImage('https://www.google.com/images/branding/googlelogo/2x/googlelogo_light_color_272x92dp.png')
                    //console.log('imageData',imageData)
                    // const img =  await canvas.loadImage(path.join(__dirname, img_url))
                    // const myCanvas = canvas.createCanvas(200, 200)

                    // const ctx = myCanvas.getContext('2d')
                    //  ctx.drawImage(img_url, 0, 0, 200, 200)
                    //  console.log('canvas image',typeof(ctx))

                    //await faceapi.computeFaceDescriptor(canvasData)

                    //const detections =  faceapi.detectSingleFace(img)

                    //base 64



                    // const img = await faceapi.fetchImage(image.photo_url)
                     //console.log('img',img)

                    //descriptors.push(await faceapi.computeFaceDescriptor(img))
                    //console.log(img)
                    //console.log(await faceapi.computeFaceDescriptor(img))

                    // return new faceapiTs.LabeledFaceDescriptors(
                    //     'user_'+img.id,
                    //     descriptors
                    // )
                }
            )
        )

        // const labeledFaceDescriptors = await Promise.all(classes.map(
        // async className => {
        //     const descriptors = []
        //     for (let i = 1; i < (numImagesForTraining + 1); i++) {
        //     const img = await faceapi.fetchImage(getFaceImageUri(className, i))
        //     descriptors.push(await faceapi.computeFaceDescriptor(img))
        //     }

        //     return new faceapi.LabeledFaceDescriptors(
        //     className,
        //     descriptors
        //     )
        // }
        // ))

        //return new faceapi.FaceMatcher(labeledFaceDescriptors,0.5)
    }

    async function loadModels() {
        await faceDetectionNet.loadFromDisk(MODEL_URL)
        await faceapiTs.nets.faceLandmark68Net.loadFromDisk(MODEL_URL)
        await faceapiTs.nets.faceRecognitionNet.loadFromDisk(MODEL_URL)
    }
    async function runFaceMatch(criminals:{}, guests:{}) {

        console.log('criminals', criminals)
        console.log('guests', guests)

        setTimeout(function() {
            console.log('This printed after about 10 second');
            //load all images in faceMatcher - train model with existing set of images
            faceMatcher =  createBbtFaceMatcher(criminals)
         // console.log('faceMatcher.. all images loaded',faceMatcher)
          }, 1000);


    }

    const getGuests = (criminals:any, callback:any) => {

        // console.log('getGuests')
        // console.log('starting..')
        // console.log('criminals..', criminals)

        axios.get(API_URL+'/guests')
        .then((response: any) => {
            let guests = response.data

            // console.log('Total '+Object.keys(guests).length+' guests found!')
            // console.log(guests)

            runFaceMatch(criminals, guests);

        })
        .catch((error:any) => {
            console.log(error);
        });
    }

    const getCriminals = (params:any, callback:any) => {

        // console.log('getCriminals')
        // console.log('starting..')

        axios.get(API_URL+'/criminals')
        .then((response:any) => {
            let criminals = response.data

            // console.log('Total '+Object.keys(criminals).length+' criminals found!')
            // console.log(criminals)

            callback(criminals);

        })
        .catch((error:any) => {
            console.log(error);
        });
    }

    async function run(){

        Promise.all([
             await faceapiTs.nets.ssdMobilenetv1.loadFromUri(MODEL_URI),
             await faceapiTs.nets.faceRecognitionNet.loadFromUri(MODEL_URI),
             await faceapiTs.nets.faceLandmark68Net.loadFromUri(MODEL_URI),

        //      faceDetectionNet.loadFromDisk(MODEL_URL),
        //  faceapi.nets.faceLandmark68Net.loadFromDisk(MODEL_URL),
        //  faceapi.nets.faceRecognitionNet.loadFromDisk(MODEL_URL)
        ]).then((val) => {
            // console here gives an array of undefined
            console.log('done loading models..')

            console.log(faceapiTs.nets.ssdMobilenetv1)
        }).catch((err) => {
            console.log(err)
        })

        //loading models
        // loadModels().then( () => {
        //     console.log('finished loading models..')
        // })

        /*****
         * STEP 1 - get data
        */
        console.log('Loading images from Dataset...')
        getCriminals( [], getGuests)


    }

    run()

/**
 * Routes
 */


    app.get('/run-face-match', (req: Request, res: Response) => {
        console.log('run-face-match... ')

        /*****
             * STEP 1
            */
        //get criminals
        getCriminals( [], (error: any, criminalsData: any) => {
            //return res.send(criminalsData);

            //if error log, and exit
            if(error) return res.send({error})

            /*****
             * STEP 2
            */
            console.log('get guest details..');
            //get guest details
            if(Object.keys(criminalsData).length){
                getGuests( [], (error: any , guestsData: any) => {

                    //if error log, and exit
                    if(error) return res.send({error})

                    return res.send([criminalsData, guestsData]);



                    // STEP 3 - Load models

                    // Train Models

                    // Confirm readiness
                    //run face match
                    //runFaceMatch()


                } )
            }

        })

    });

app.listen(PORT, () => {
    console.log("Server Listening on PORT:", PORT);
});
