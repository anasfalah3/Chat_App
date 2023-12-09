<!DOCTYPE html>
<html lang="en">

<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>ChatApp</title>
      <link rel="stylesheet" href="css/style.css">
      <link rel="stylesheet" href="css/NetworkCheck.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
      <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
      <link rel="stylesheet" href="css/loader.css">
      <style media="screen">
            .form form .success-txt {
                  color: #12731c;
                  background: #84c78b8a;
                  padding: 8px 10px;
                  text-align: center;
                  border-radius: 5px;
                  margin-bottom: 10px;
                  border: 1px solid #84c78b;
                  display: none;
            }

            .upload {
                  width: 140px;
                  position: relative;
                  margin: auto;
                  text-align: center;
            }

            .upload img {
                  border-radius: 50%;
                  border: 8px solid #DCDCDC;
                  width: 125px;
                  height: 125px;
            }

            .upload .rightRound {
                  position: absolute;
                  bottom: 0;
                  right: 0;
                  background: #00B4FF;
                  width: 32px;
                  height: 32px;
                  line-height: 33px;
                  text-align: center;
                  border-radius: 50%;
                  overflow: hidden;
                  cursor: pointer;
                  transition: 0.3s;
            }

            .upload .rightRound:hover {
                  background: #024e6e;
            }

            .upload .leftRound {
                  position: absolute;
                  bottom: 0;
                  left: 0;
                  background: red;
                  width: 32px;
                  height: 32px;
                  line-height: 33px;
                  text-align: center;
                  border-radius: 50%;
                  overflow: hidden;
                  cursor: pointer;
                  transition: 0.3s;
            }

            .upload .leftRound:hover {
                  background: rgb(112, 4, 4);
            }

            .upload .fa {
                  color: white;
                  transition: 0.3s;
            }

            .upload input {
                  position: absolute;
                  transform: scale(2);
                  opacity: 0;
            }

            .upload input::-webkit-file-upload-button {
                  cursor: pointer;
            }
      </style>
</head>