import express from 'express'
import {config} from 'dotenv';
import axios from 'axios';
import request from 'postman-request'
//import axiosClient from './axios-client.js';

import * as faceapi from 'face-api.js';
import faceDetectionNet from './commons/faceDetection.js'
//import { canvas, faceDetectionNet, faceDetectionOptions, saveFile } from './commons/';


const settings = config().parsed;

const app = express ();
app.use(express.json());

let PORT = 4000
settings.STATUS == 'production'
    ? (PORT = settings.PROD_PORT)
    : (PORT = settings.DEV_PORT)

const API_URL = settings.API_URL


axios.create({baseUrl: settings.API_URL+"/api"});

/**
 * functions
 */



    // STEP 2 - Get Guest
    const getGuests = (settings, callback) => {

        console.log('getGuests')
        console.log('starting..')

        axios.get(API_URL+'/guests')
        .then((response) => {
            let guests = response.data

            console.log('Total '+Object.keys(guests).length+' guests found!')
            console.log(guests)

            callback(undefined, guests);

        })
        .catch((error) => {
            console.log(error);
        });
    }

    // STEP 1 - Get Criminals
    const getCriminals = (settings, callback) => {

        console.log('getCriminals')
        console.log('starting..')

        axios.get(API_URL+'/criminals')
        .then((response) => {
            let criminals = response.data

            console.log('Total '+Object.keys(criminals).length+' criminals found!')
            console.log(criminals)

            callback(undefined, criminals);

        })
        .catch((error) => {
            console.log(error);
        });
    }





/**
 * Routes
 */

    /**
     * Home
     */
    app.get('/', (req, res) => {
        res.send('');
    });


    app.get('/run-face-match', (req, res) => {
        console.log('run-face-match... ')

        /*****
             * STEP 1
            */
        //get criminals
        getCriminals( settings, (error, criminalsData) => {
            //return res.send(criminalsData);

            //if error log, and exit
            if(error) return res.send({error})

            /*****
             * STEP 2
            */
            console.log('get guest details..');
            //get guest details
            if(Object.keys(criminalsData).length){
                getGuests( settings, (error, guestsData) => {

                    //if error log, and exit
                    if(error) return res.send({error})

                    return res.send([criminalsData, guestsData]);



                    // STEP 3 - Load models

                    // Train Models

                    // Confirm readiness
                    //run face match
                    runFaceMatch()


                } )
            }

        })

      });

/**
 * Routes
 */
app.listen(PORT, () => {
    console.log("Server Listening on PORT:", PORT);
});


