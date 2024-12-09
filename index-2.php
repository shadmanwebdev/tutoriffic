<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&family=Roboto:wght@400;500&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="css/form-response.css">
    <link rel="stylesheet" href="css/loader.css">
    <link rel="stylesheet" href="css/popup.css">
    
</head>
<body>

    <div id='loader'></div>
    <div id='popBg' onclick='closePopup();'></div>

<style>
    body {
        background-color: rgb(255, 239, 230);
        font-family: 'Roboto', sans-serif;
        /* box-sizing: border-box; */
    }
    .logo-lg {
        max-height: 22.436500470366887vw;
        max-width: 90vw;
        height: 159.54844778927566px;
        width: 640px;
        background-image: url('assets/tutoriffic-lg.png');
        background-size: cover;
        background-position: center;
        border: 1px solid rgb(218,220,224);
        border-radius: 8px;
        margin: 12px auto;
    }
</style>

<style>
    /* Page Wrapper */
    .Uc2NEf {
        display: -webkit-box;
        display: -webkit-flex;
        display: flex;
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
        -webkit-flex-direction: column;
        flex-direction: column;
    }
    /* Background image */
    .KHCwJ {
        background-image: url('https://lh3.googleusercontent.com/Bvxf1JvF_BrP7TeMmZK2Vp1-rtMUcJ9v0fNvlkmKQeoHfUsr_djWe8yaOp0XlzsCX0PEbFEMj-KEM5yKxKcH1b-b06_KjtYgaOn7PWagA20bCBqP9EnKwhILOwrx3drPdw=w1063');
        background-size: cover;
        background-position: center;
    }
    /* Form wrapper */
    .teQAzf {
        margin: auto;
        max-width: 90vw;
        width: 640px;
    }
    /* 1 */
    .RVEQke {
        background-color: rgb(255, 176, 128);
        color: rgba(0, 0, 0, 1);
    }

    .JH79cc {
        border-top-left-radius: 8px;
        border-top-right-radius: 8px;
        height: 10px;
        left: -1px;
        position: absolute;
        top: -1px;
        width: calc(100% + 2px);
    }
    .tIvQIf .N0gd6 {
        padding-bottom: 12px;
    }
    .tIvQIf.m7w29c {
        padding-bottom: 16px;
    }
    .m7w29c {
        margin-top: 12px;
        background-color: #fff;
        border: 1px solid rgb(218,220,224);
        border-radius: 8px;
        margin-bottom: 12px;
        padding: 24px;
        padding-top: 22px;
        position: relative;
    }
    .ahS2Le {
        -webkit-box-align: center;
        -webkit-align-items: center;
        align-items: center;
        display: -webkit-box;
        display: -webkit-flex;
        display: flex;
        -webkit-flex-wrap: wrap;
        flex-wrap: wrap;
        -webkit-box-pack: justify;
        -webkit-justify-content: space-between;
        justify-content: space-between;
    }

    .F9yp7e {
        box-sizing: border-box;
        font-family: "Google Sans", Roboto, Arial, sans-serif;
        font-size: 32px;
        font-weight: 400;
        line-height: 40px;
        color: rgb(32,33,36);
        line-height: 135%;
        max-width: 100%;
        min-width: 0;
    }
    
    @media (max-width: 560px) {
        .F9yp7e {
            font-size: 24px;
        }
    }
    .LgNcQe, .LgNcQe .Wic03c .tL9Q4c, .LgNcQe .I9OJHe .KRoqRc, .LgNcQe .PyrB4, .LgNcQe .snByac {
        font-size: 24pt;
        font-family: 'docs-Roboto', Helvetica, Arial, sans-serif;
        letter-spacing: 0;
    }
    .OIC90c, .OIC90c.RjsPE, .OIC90c .zHQkBf, .OIC90c .Wic03c .tL9Q4c, .OIC90c .I9OJHe .KRoqRc, .OIC90c .PyrB4, .OIC90c .snByac {
        font-size: 11pt;
        line-height: 15pt;
        letter-spacing: 0;
    }
    /* Border */
    .tIvQIf .zAVwcb {
        border-top: 1px solid rgb(218,220,224);
        left: 0;
        position: absolute;
        width: 100%;
    }
    .tIvQIf .DqBBlb {
        color: rgb(95,99,104);
    }
    /* Saving disabled */

    @media (max-width: 560px) {
        .Oh1Vtf {
            -webkit-flex-wrap: wrap;
            flex-wrap: wrap;
        }
    }
    .Oh1Vtf {
        font-family: Roboto,Arial,sans-serif;
        font-size: 14px;
        font-weight: 400;
        letter-spacing: .2px;
        line-height: 20px;
        display: -webkit-box;
        display: -webkit-flex;
        display: flex;
        -webkit-flex-wrap: nowrap;
        flex-wrap: nowrap;
        -webkit-box-pack: justify;
        -webkit-justify-content: space-between;
        justify-content: space-between;
    }
    @media (max-width: 560px) {
        .UpwdYb {
            -webkit-flex-shrink: 0;
            flex-shrink: 0;
            margin-top: 12px;
        }
    }
    .UpwdYb {
        display: -webkit-box;
        display: -webkit-flex;
        display: flex;
    }
    .K9n9ye, .K9n9ye .Bc2jY {
        -webkit-box-align: center;
        -webkit-align-items: center;
        align-items: center;
        display: -webkit-box;
        display: -webkit-flex;
        display: flex;
    }
    .K9n9ye .Bc2jY {
        -webkit-box-pack: center;
        -webkit-justify-content: center;
        justify-content: center;
        margin-right: 12px;
        width: 24px;
    }
    @media (max-width: 560px) {
        .K9n9ye .pMDWAf {
            max-width: 100%;
        }
    }
    .K9n9ye .pMDWAf {
        font-family: Roboto,Arial,sans-serif;
        font-size: 12px;
        font-weight: 400;
        letter-spacing: .3px;
        line-height: 16px;
        color: rgb(95,99,104);
        max-width: 180px;
    }

    /* Indicates required questions */
    .cBGGJ, .md0UAd, .aGYtCb {
        font-family: Roboto,Arial,sans-serif;
        font-size: 14px;
        font-weight: 400;
        letter-spacing: 0.2px;
        line-height: 20px;
        color: rgb(32,33,36);
        margin-top: 12px;
    }
    
    .zAVwcb + .md0UAd {
        margin-top: 24px;
        margin-bottom: 8px;
    }
    .md0UAd {
        color: rgb(217,48,37);
    }
</style>


<style>
    .error  > div {
        color: rgb(217,48,37);
        font-size: 14px;
        font-weight: 400;
        letter-spacing: 0.2px;
        line-height: 20px;
    }
</style>


<div class='logo-lg'>

</div>
<div class="Uc2NEf" style='margin-bottom: 100px;'>
    <div class="vnFTpb teQAzf ErmvL KHCwJ"></div>
    <div class="teQAzf">
        <form action="https://docs.google.com/forms/u/0/d/e/1FAIpQLScWlzZAxKM-XrMRrThzpQkPClwML0ou8A5KgDWBmuXGWhd1vg/formResponse" target="_self" method="POST" id="mG61Hd" jsmodel="TOfxwf Q91hve CEkLOc" data-shuffle-seed="-666793035833726656" data-clean-viewform-url="https://docs.google.com/forms/d/e/1FAIpQLScWlzZAxKM-XrMRrThzpQkPClwML0ou8A5KgDWBmuXGWhd1vg/viewform" data-response="%.@.]" data-dlp-data="%.@.null,false]" data-first-entry="0" data-last-entry="7" data-is-first-page="true">
            <!-- 1 -->
            <div class="Dq4amc">
                <div class="m7w29c O8VmIc tIvQIf">
                    <div class="JH79cc RVEQke b33AEc"></div>
                    <div class="N0gd6">
                        <div class="ahS2Le">
                            <div class="F9yp7e ikZYwf LgNcQe" dir="auto" role="heading" aria-level="1">
                            Tutoriffic Sign up!
                            </div>
                        </div>
                        <div class="cBGGJ OIC90c" dir="auto">
                            Fill in this quick form to register your interest, we will reach out to you when our site is back online!
                        </div>
                        <div jsname="F0H8Yc" class="liS6Hc"></div>
                    </div>
                    <div class="zAVwcb"></div>
                    <div class="DqBBlb">
                        <div class="md0UAd" aria-hidden="true" dir="auto">* Indicates required question</div>
                    </div>
                </div>
            </div>

            <!-- 2 -->
            <style>
                /* Wrapper */
                .geS5n {
                    -webkit-transition: background-color .2s cubic-bezier(0,0,.2,1);
                    transition: background-color .2s cubic-bezier(0,0,.2,1);
                    background-color: #fff;
                    border: 1px solid rgb(218,220,224);
                    border-radius: 8px;
                    margin-bottom: 12px;
                    padding: 24px;
                    page-break-inside: avoid;
                    word-wrap: break-word;
                }
                /* Heading */
                .z12JJ {
                    display: -webkit-box;
                    display: -webkit-flex;
                    display: flex;
                    -webkit-box-pack: justify;
                    -webkit-justify-content: space-between;
                    justify-content: space-between;
                    margin-bottom: 16px;
                }
                .M4DNQ {
                    -webkit-box-align: start;
                    -webkit-align-items: flex-start;
                    align-items: flex-start;
                    box-sizing: border-box;
                    display: -webkit-box;
                    display: -webkit-flex;
                    display: flex;
                    -webkit-box-orient: vertical;
                    -webkit-box-direction: normal;
                    -webkit-flex-direction: column;
                    flex-direction: column;
                    max-width: 100%;
                    min-width: 0;
                    position: relative;
                }
                .HoXoMd.RjsPE {
                    font-family: Roboto, Arial, sans-serif;
                    font-size: 16px;
                    font-weight: 500;
                    letter-spacing: .2px;
                    line-height: 24px;
                    color: rgb(32,33,36);
                    font-weight: 400;
                }
                /* Required */
                .vnumgf {
                    color: rgb(217,48,37);
                    padding-left: .25em;
                }
                .HoXoMd.RjsPE {
                    font-family: Roboto,Arial,sans-serif;
                    font-size: 16px;
                    font-weight: 500;
                    letter-spacing: .2px;
                    line-height: 24px;
                    color: rgb(32,33,36);
                    font-weight: 400;
                }
                /* Radio inputs wrapper */
                .SG0AAe {
                    display: -webkit-box;
                    display: -webkit-flex;
                    display: flex;
                    -webkit-flex-wrap: wrap;
                    flex-wrap: wrap;
                    -webkit-box-pack: justify;
                    -webkit-justify-content: space-between;
                    justify-content: space-between;
                    width: 100%;
                }
                /* Input wrapper */
                .nWQGrd {
                    display: -webkit-box;
                    display: -webkit-flex;
                    display: flex;
                    width: 100%;
                    min-height: 24px;
                    padding: .5em .5em .5em 0;
                }
                /* Label */
                .ajBQVb {
                    width: 100%;
                }
                .docssharedWizToggleLabeledContainer {
                    display: -webkit-box;
                    display: -webkit-flex;
                    display: flex;
                    -webkit-box-orient: horizontal;
                    -webkit-box-direction: normal;
                    -webkit-flex-direction: row;
                    flex-direction: row;
                    -webkit-box-flex: 1;
                    -webkit-flex-grow: 1;
                    flex-grow: 1;
                    -webkit-box-pack: justify;
                    -webkit-justify-content: space-between;
                    justify-content: space-between;
                }
                .bzfPab {
                    -webkit-box-align: center;
                    -webkit-align-items: center;
                    align-items: center;
                    display: -webkit-box;
                    display: -webkit-flex;
                    display: flex;
                    -webkit-flex-shrink: 1;
                    flex-shrink: 1;
                    min-width: 0;
                }
                /* Radio */
                /* Label */
                .zfdaxb .ajBQVb {
                    -webkit-box-flex: 0;
                    -webkit-flex-grow: 0;
                    flex-grow: 0;
                    padding-right: 20px;
                    width: auto;
                }
                .d7L4fc {
                    display: inline-block;
                    -webkit-flex-shrink: 0;
                    -webkit-flex-shrink: 0;
                    flex-shrink: 0;
                    height: 20px;
                    position: relative;
                    vertical-align: middle;
                    width: 20px;
                    z-index: 0;
                }
                .cNDBpf .hYsg7c, .cNDBpf .MbhUzd, .cNDBpf .Id5V1 {
                    bottom: 0;
                    height: 20px;
                    left: 0;
                    right: 0;
                    top: 0;
                    width: 20px;
                }
                .x0k1lc {
                    bottom: 10px;
                    left: 10px;
                    position: absolute;
                    right: 10px;
                    top: 10px;
                    -webkit-transform: scale(1);
                    transform: scale(1);
                    -webkit-transition: opacity .15s ease;
                    transition: opacity .15s ease;
                    background-color: rgba(218,220,224,.2);
                    -webkit-border-radius: 100%;
                    border-radius: 100%;
                    height: 20px;
                    opacity: 0;
                    outline: .1px solid transparent;
                    pointer-events: none;
                    width: 20px;
                    z-index: -1;
                }
                .Od2TWd {
                    bottom: -10px;
                    left: -10px;
                    position: absolute;
                    right: -10px;
                    top: -10px;
                    -webkit-transition: border-color .2s cubic-bezier(0.4,0,0.2,1);
                    transition: border-color .2s cubic-bezier(0.4,0,0.2,1);
                    -webkit-user-select: none;
                    -webkit-tap-highlight-color: transparent;
                    -webkit-border-radius: 3px;
                    border-radius: 3px;
                    -webkit-box-sizing: border-box;
                    box-sizing: border-box;
                    cursor: pointer;
                    height: 40px;
                    outline: none;
                    width: 40px;
                    z-index: 0;
                }
                .vd3tt {
                    -webkit-animation: agmAnimateSelectOut .2s forwards;
                    animation: agmAnimateSelectOut .2s forwards;
                    cursor: pointer;
                    height: 20px;
                    position: relative;
                    width: 20px;
                }
                @keyframes agmAnimateSelectOut {
                    0% {
                        height: 0;
                        width: 0;
                    }
                    100% {
                        height: 100%;
                        width: 100%;
                    }
                }
                .aomaEc.N2RpBe:not(.RDPZE) .Id5V1, .aomaEc .nQOrEb {
                    border-color: rgb(210, 79, 0);
                }

                .vd3tt {
                    -webkit-animation: agmAnimateSelectOut .2s forwards;
                    animation: agmAnimateSelectOut .2s forwards;
                    cursor: pointer;
                    height: 20px;
                    position: relative;
                    width: 20px;
                }
                .AB7Lab {
                    bottom: 10px;
                    left: 10px;
                    position: absolute;
                    right: 10px;
                    top: 10px;
                    border: solid 2px;
                    border-color: #5f6368;
                    -webkit-border-radius: 50%;
                    border-radius: 50%;
                    -webkit-box-sizing: border-box;
                    box-sizing: border-box;
                    height: 20px;
                    width: 20px;
                }
                .rseUEf {
                    border: 5px solid #1a73e8;
                    -webkit-border-radius: 50%;
                    border-radius: 50%;
                    left: 50%;
                    position: absolute;
                    top: 50%;
                    transition: -webkit-transform ease .28s;
                    -webkit-transition: -webkit-transform ease .28s;
                    -webkit-transition: transform ease .28s;
                    transition: transform ease .28s;
                    -webkit-transition: transform ease .28s,-webkit-transform ease .28s;
                    transition: transform ease .28s,-webkit-transform ease .28s;
                    -webkit-transform: translateX(-50%) translateY(-50%) scale(0);
                    -webkit-transform: translateX(-50%) translateY(-50%) scale(0);
                    transform: translateX(-50%) translateY(-50%) scale(0);
                }
                .Od2TWd.N2RpBe .rseUEf {
                    -webkit-transform: translateX(-50%) translateY(-50%) scale(1);
                    -webkit-transform: translateX(-50%) translateY(-50%) scale(1);
                    transform: translateX(-50%) translateY(-50%) scale(1);
                }
                .aomaEc .N2RpBe:not(.RDPZE) .Id5V1 {
                    border-color: rgb(210, 79, 0);
                }

                /* Radio text */
                .YEVVod {
                    display: -webkit-box;
                    display: -webkit-flex;
                    display: flex;
                    -webkit-box-orient: vertical;
                    -webkit-box-direction: normal;
                    -webkit-flex-direction: column;
                    flex-direction: column;
                    -webkit-box-flex: 1;
                    -webkit-flex-grow: 1;
                    flex-grow: 1;
                    -webkit-box-pack: center;
                    -webkit-justify-content: center;
                    justify-content: center;
                    margin-left: .75em;
                    min-width: 0;
                }

                /* Text input */
                .pIDwKe {
                    -webkit-box-flex: 1;
                    -webkit-flex-grow: 1;
                    flex-grow: 1;
                    min-width: 200px;
                }
                .SjlgO {
                    display: block;
                    width: 100%;
                }
                .KzNPgc {
                    position: relative;
                    vertical-align: top;
                }
                .JGptt {
                    display: -webkit-box;
                    display: -webkit-flex;
                    display: -webkit-box;
                    display: -webkit-flex;
                    display: flex;
                }
                div {
                    display: block;
                }
                .RWzxl {
                    -webkit-user-select: none;
                    -webkit-user-select: none;
                    -webkit-tap-highlight-color: transparent;
                    display: inline-block;
                    outline: none;
                    width: 200px;
                }

                .Hvn9fb {
                    -webkit-box-flex: 1;
                    -webkit-flex-grow: 1;
                    -webkit-box-flex: 1;
                    box-flex: 1;
                    -webkit-flex-grow: 1;
                    flex-grow: 1;
                    -webkit-flex-shrink: 1;
                    -webkit-flex-shrink: 1;
                    flex-shrink: 1;
                    background-color: transparent;
                    border: none;
                    display: block;
                    font: 400 16px Roboto,RobotoDraft,Helvetica,Arial,sans-serif;
                    margin: 0;
                    min-width: 0%;
                    outline: none;
                    padding: .125em 0;
                    z-index: 0;
                }
                /* Border bottom */
                .kPBwDb {
                    -webkit-transform: scaleX(0);
                    -webkit-transform: scaleX(0);
                    transform: scaleX(0);
                    background-color: #03a9f4;
                    height: 2px;
                    margin: 0;
                    padding: 0;
                    width: 100%;
                }
                .SPcBRc {
                    background-color: rgba(0,0,0,.12);
                    height: 1px;
                    margin: 0;
                    padding: 0;
                    width: 100%;
                }
                .yqQS1 .cXrdqd {
                    background-color: rgb(210, 79, 0);
                }
                .kPBwDb.Y2Zypf {
                    -webkit-animation: quantumWizSimpleInputRemoveUnderline .3s cubic-bezier(0.4,0,0.2,1);
                    -webkit-animation: quantumWizSimpleInputRemoveUnderline .3s cubic-bezier(0.4,0,0.2,1);
                    animation: quantumWizSimpleInputRemoveUnderline .3s cubic-bezier(0.4,0,0.2,1);
                }
                @keyframes quantumWizSimpleInputRemoveUnderline {
                    0% {
                        -webkit-transform: scaleX(1);
                        -webkit-transform: scaleX(1);
                        transform: scaleX(1);
                        opacity: 1;
                    }
                    100% {
                        -webkit-transform: scaleX(1);
                        -webkit-transform: scaleX(1);
                        transform: scaleX(1);
                        opacity: 0;
                    }
                }
            </style>

            <style>
                .input-container {
                    font-family: Roboto,Arial,sans-serif;
                    display: block;
                    /* width: 100%; */
                    -webkit-transition: background-color .2s cubic-bezier(0,0,.2,1);
                    transition: background-color .2s cubic-bezier(0,0,.2,1);
                    background-color: #fff;
                    border: 1px solid rgb(218,220,224);
                    border-radius: 8px;
                    margin-bottom: 12px;
                    padding: 24px;
                    page-break-inside: avoid;
                    word-wrap: break-word;
                }
                #inputLabel {
                    display: block;
                    font-size: 16px;
                    letter-spacing: .2px;
                    line-height: 24px;
                    color: rgb(32,33,36);
                    font-weight: 400;
                    margin-bottom: 26px;
                }
                .required {
                    color: rgb(217,48,37);
                    padding-left: .25em;
                }
                .input-wrapper {
                    width: 50%;
                    display: flex;
                    flex-direction: column;
                    padding-bottom: 8px;
                }

                .text-input {
                    font-family: Roboto,Arial,sans-serif;
                    font-size: 14px;
                    font-weight: 400;
                    letter-spacing: .2px;
                    line-height: 24px;
                    color: rgb(32,33,36);
                    border-top: none;
                    border-left: none;
                    border-right: none;
                    border-bottom: 1px solid rgba(0,0,0,.12);
                    outline: none;
                }
                input.text-input:focus {
                    border-top: none;
                    border-left: none;
                    border-right: none;
                    border-bottom: 1px solid rgba(0,0,0,.12);
                    outline: none;
                }
            </style>


            <style>
                .radios {
                    display: flex;
                    flex-flow: column nowrap;
                }
                .radio-option {
                    margin-bottom: 20px;
                }
                .radio-input-group {
                    
                    display: flex;
                    flex-flow: row nowrap;
                    align-items: center;
                }
                .radio-input-inner {
                    margin-right: 10px;
                    height: 20px;
                }
                /* Style for the radio inputs */
                input[type="radio"] {
                    display: none; /* Hide the default radio input */
                }

                /* Style for the radio label */
                .radio-label {
                    display: inline-block;
                    width: 12px;
                    height: 12px;
                    padding: 2px; /* Adjust the padding to add spacing */
                    /* border: 2px solid rgb(210, 79, 0); */
                    border: 2px solid rgb(104 104 104);
                    color: rgb(210, 79, 0);
                    cursor: pointer;
                    border-radius: 50%;
                    position: relative;
                }

                /* Style for the selected radio label */
                .radio-label.selected {
                    border: 2px solid rgb(210, 79, 0);
                    background-color: white;
                    color: white;
                }
                /* Style for the inner circle of the selected radio label */
                .radio-label.selected::before {
                    content: "";
                    display: block;
                    width: 10px;
                    height: 10px;
                    background-color: rgb(210, 79, 0);
                    border-radius: 50%;
                    position: absolute;
                    top: 50%;
                    left: 50%;
                    transform: translate(-50%, -50%);
                }
                .radio-text {
                    font-size: 15px;
                }
            </style>

            <style>
                .form-footer {
                    display: flex; 
                    flex-flow: row nowrap; 
                    align-items: center; 
                    justify-content: space-between;
                }
                .submit-btn {
                    display: block;
                    padding: 0 24px;
                    color: #fff;
                    background-color: rgb(210, 79, 0);
                    font-size: 14px;
                    font-weight: 500;
                    letter-spacing: .25px;
                    line-height: 36px;
                    text-decoration: none;
                    text-transform: none;
                    min-width: auto;
                    outline: none;
                    text-align: center;
                    -webkit-tap-highlight-color: transparent;
                    cursor: pointer;
                }
                .clear-btn {
                    display: block;
                    padding: 0 8px;
                    color: rgb(210, 79, 0);
                    font-size: 14px;
                    font-weight: 500;
                    letter-spacing: .25px;
                    line-height: 36px;
                    text-decoration: none;
                    text-transform: none;
                    min-width: auto;
                    outline: none;
                    overflow: hidden;
                    cursor: pointer;
                }
                .steps {
                    display: flex; 
                    flex-flow: row nowrap; 
                    align-items: center; 
                    justify-content: space-between;
                }
                .progress-bar {
                    border-radius: 40px;
                    width: 184px;
                    height: 10px;
                    background: rgb(52,168,83);
                }
                .page {
                    font-size: 14px;
                    font-weight: 400;
                    letter-spacing: .2px;
                    line-height: 20px;
                    color: rgb(32,33,36);
                    display: inline-block;
                    padding: 0 12px;
                }
                @media screen and (max-width: 768px) {
                    .form-footer {
                        padding-top: 80px;
                        position: relative;
                    }
                    .steps {
                        position: absolute;
                        top: 20px;
                        left: 50%;
                        margin-left: -120px;
                    }
                }
            </style>

            <div class="input-list" role="list">


                <!-- Account type -->
                <div class="input-container">

                    <label for='firstname' id="inputLabel">Are you a Student, Tutor, Tuition centre or Other? <span class='required'>*</span></label>

                    <div class='radios account-type-wrapper' style='position: relative;'>

                        <!-- Student -->
                        <div class="radio-option">
                            <div class='radio-input-group'>
                                <div class='radio-input-inner'>
                                    <input class='' name="account_type" id="student" type="radio" value="Student" checked>
                                    <label class="radio-label selected" for="student" onclick="handleRadioSelection(this)" for="student"></label>
                                </div>
                                <div class='radio-text'>Student</div>
                            </div>
                        </div>

                        <!-- Tutor -->
                        <div class="radio-option">
                            <div class='radio-input-group'>
                                <div class='radio-input-inner'>
                                    <input name="account_type" id="tutor" type="radio" value="Tutor">
                                    <label class="radio-label" for="tutor" onclick="handleRadioSelection(this)" for="tutor"></label>
                                </div>
                                <div class='radio-text'>Tutor</div>
                            </div>
                        </div>

                        <!-- Parent -->
                        <div class="radio-option">
                            <div class='radio-input-group'>
                                <div class='radio-input-inner'>
                                    <input name="account_type" id="parent" type="radio" value="Parent">
                                    <label class="radio-label" for="parent" onclick="handleRadioSelection(this)" for="parent"></label>
                                </div>
                                <div class='radio-text'>Parent</div>
                            </div>
                        </div>

                        <!-- Tuition centre -->
                        <div class="radio-option">
                            <div class='radio-input-group'>
                                <div class='radio-input-inner'>
                                    <input name="account_type" id="tution-center" type="radio" value="Tuition centre">
                                    <label class="radio-label" for="tution-center" onclick="handleRadioSelection(this)" for="tution-center"></label>
                                </div>
                                <div class='radio-text'>Tuition centre</div>
                            </div>
                        </div>
                        

                        <!-- Other -->
                        <div class="radio-option">
                            <div class='radio-input-group'>
                                <div class='radio-input-inner'>
                                    <input name="account_type" id="other" type="radio" value="Other">
                                    <label class="radio-label" for="other" onclick="handleRadioSelection(this)" for="other"></label>
                                </div>
                                <div class='radio-text' style='display: flex; flex-flow: row nowrap; line-height: 1;'>
                                    <div style='display: flex; align-items: center;  margin-right: 20px;'>Other:</div>
                                    <input style='width: 200px; line-height: 18px;' type="text" class="text-input" id='other_details' name='other_details'>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    

                    <div id="errorAccountType" class="error"></div>
                </div>



                <!-- First name -->
                <div class="input-container">
                    <div class="input-wrapper firstname-wrapper">
                        <label for='firstname' id="inputLabel">First Name <span class='required'>*</span></label>
                        <input type="text" class="text-input" id='firstname' name='firstname' placeholder='Your answer'>
                    </div>
                    <div id="errorFname" class="error"></div>
                </div>

                <!-- Last name -->
                <div class="input-container">
                    <div class="input-wrapper lastname-wrapper">
                        <label for='lastname' id="inputLabel">Last Name <span class='required'>*</span></label>
                        <input type="text" class="text-input" id='lastname' name='lastname' placeholder='Your answer'>
                    </div>
                    <div id="errorLname" class="error"></div>
                </div>
            
                <!-- Email -->
                <div class="input-container">
                    <div class="input-wrapper email-wrapper">
                        <label for='email' id="inputLabel">Email <span class='required'>*</span></label>
                        <input type="text" class="text-input" id='email' name='email' placeholder='Your answer'>
                    </div>
                    <div id="errorEmail" class="error"></div>
                </div>

                <!-- Phone -->
                <div class="input-container">
                    <div class="input-wrapper phone-wrapper">
                        <label for='phone' id="inputLabel">Contact Number (Optional) <span class='required'>*</span></label>
                        <input type="text" class="text-input" id='phone' name='phone' placeholder='Your answer'>
                    </div>
                    <div id="errorPhone" class="error"></div>
                </div>

                <!-- Socials -->
                <div class="input-container">

                    <label for='social' id="inputLabel">Where did you hear about us? <span class='required'>*</span></label>

                    <div class='radios social-media-wrapper' style='position: relative;'>

                        <!-- Instagram -->
                        <div class="radio-option">
                            <div class='radio-input-group'>
                                <div class='radio-input-inner'>
                                    <input class='' name="social" id="instagram" type="radio" value="Instagram">
                                    <label class="radio-label" for="instagram" onclick="handleRadioSelection(this)" for="instagram"></label>
                                </div>
                                <div class='radio-text'>Instagram</div>
                            </div>
                        </div>

                        <!-- LinkedIn -->
                        <div class="radio-option">
                            <div class='radio-input-group'>
                                <div class='radio-input-inner'>
                                    <input name="social" id="linkedin" type="radio" value="LinkedIn">
                                    <label class="radio-label" for="linkedin" onclick="handleRadioSelection(this)" for="linkedin"></label>
                                </div>
                                <div class='radio-text'>LinkedIn</div>
                            </div>
                        </div>

                        <!-- Facebook -->
                        <div class="radio-option">
                            <div class='radio-input-group'>
                                <div class='radio-input-inner'>
                                    <input name="social" id="facebook" type="radio" value="Facebook">
                                    <label class="radio-label" for="facebook" onclick="handleRadioSelection(this)" for="facebook"></label>
                                </div>
                                <div class='radio-text'>Facebook</div>
                            </div>
                        </div>
                        
                        <!-- Google -->
                        <div class="radio-option">
                            <div class='radio-input-group'>
                                <div class='radio-input-inner'>
                                    <input name="social" id="google" type="radio" value="Google">
                                    <label class="radio-label" for="google" onclick="handleRadioSelection(this)" for="google"></label>
                                </div>
                                <div class='radio-text'>Google</div>
                            </div>
                        </div>

                        <!-- Tiktok -->
                        <div class="radio-option">
                            <div class='radio-input-group'>
                                <div class='radio-input-inner'>
                                    <input name="social" id="tiktok" type="radio" value="Tiktok">
                                    <label class="radio-label" for="tiktok" onclick="handleRadioSelection(this)" for="tiktok"></label>
                                </div>
                                <div class='radio-text'>Tiktok</div>
                            </div>
                        </div>

                        <!-- Other -->
                        <div class="radio-option">
                            <div class='radio-input-group'>
                                <div class='radio-input-inner'>
                                    <input name="social" id="other_social" type="radio" value="other_social">
                                    <label class="radio-label" for="other_social" onclick="handleRadioSelection(this)" for="paid"></label>
                                </div>
                                <div class='radio-text' style='display: flex; flex-flow: row nowrap; line-height: 1;'>
                                    <div style='display: flex; align-items: center;  margin-right: 20px;'>Other:</div>
                                    <input style='width: 200px; line-height: 18px;' type="text" class="text-input" id='other_social_details' name='other_social_details'>
                                    
                                </div>
                            </div>
                        </div>

                    </div>
                    

                    <div id="errorSocial" class="error"></div>
                </div>

                
                <!-- Questions/comments -->
                <div class="input-container">
                    <div class="input-wrapper questions-wrapper" style='width: 100%;'>
                        <label for='questions' id="inputLabel">Any questions/comments for us? <span class='required'>*</span></label>
                        <input type="text" class="text-input" id='questions' name='questions' placeholder='Your answer'>
                    </div>
                    <div id="errorQuestion" class="error"></div>
                </div>


                <div class='form-footer'>
                    <span class='submit-btn' onclick='join(event)'>Submit</span>
                    <div class="steps">
                        <span class='progress-bar'></span>
                        <div class="page">Page 1 of 1</div>
                    </div>
                    <span class='clear-btn' onclick='clear_form(event)'>Clear Form</span>
                </div>
                <style>
                    .message-response > div {
                        width: auto;
                    }
                </style>
                <div class='message-response' id='message-response'></div>
            </div>




        </form>
    </div>






</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>            
<script src="js/main.js" defer></script>
<script src="js/popup.js" defer></script>
<script defer>
    function clear_form(event) {
         ;
        
        $('#firstname').val('');
        $('#lastname').val('');
        $('#email').val('');
        $('#phone').val('');
        $('#questions').val('');
        $("input[name='account_type']:checked").next().removeClass('selected');

        $("input[name='account_type']:checked").prop('checked', false);
        $("input[id='student']").next().addClass('selected');
        $("input[id='student']").prop('checked', true);

        $('#other_details').val('');
        
        $("input[name='social']:checked").next().removeClass('selected');
        $("input[name='social']:checked").prop('checked', false);
        $('#other_social_details').val('');
    }
    function join(event) {
         ;

        var formData = new FormData();

        const fname = $('#firstname').val();
        const lname = $('#lastname').val();
        const email = $('#email').val();
        const phone = $('#phone').val();
        const questions = $('#questions').val();
        const user_account_type = $("input[name='account_type']:checked").val();
        const other_details = $('#other_details').val();
        const social_media = $("input[name='social']:checked").val();
        const other_social_details = $('#other_social_details').val();

        console.log(fname, lname, email, phone, 
        questions, user_account_type, other_details, 
        social_media, other_social_details);

        // Validate other fields as needed...

        // Handle account type "Other" option
        if (user_account_type === 'Other') {
            if (!other_details) {
                $('#errorAccountType').html('<div>Details for "Other" option are required</div>');
            } else {
                $('#errorAccountType').html(''); // Clear error message if valid
            }
            formData.append('other_account_type_details', other_details);
        }

        // Handle social media "Other" option
        if (social_media === 'other_social') {
            if (!other_social_details) {
                $('#errorSocial').html('<div>Details for "Other" option are required</div>');
            } else {
                $('#errorSocial').html(''); // Clear error message if valid
            }
            formData.append('other_social_details', other_social_details);
        }

        // Validate other fields as needed...

        if (
            fname 
            && lname 
            && email && user_account_type && social_media && questions
        ) {
            load_start();

            $('#errorAccountType').html('');
            $('#errorSocial').html('');
            $('#errorFname').html('');
            $('#errorLname').html('');
            $('#errorEmail').html('');
            $('#errorPhone').html('');
            $('#errorQuestion').html('');
            $('#account-type-wrapper').removeClass('invalid');
            $('#social-media-wrapper').removeClass('invalid');
            $('#firstname-wrapper').removeClass('invalid');
            $('#lastname-wrapper').removeClass('invalid');
            $('#email-wrapper').removeClass('invalid');
            $('#phone-wrapper').removeClass('invalid');
            $('#questions-wrapper').removeClass('invalid');

            formData.append('prelaunch_sign_up', 'true');

            formData.append('fname', fname);
            formData.append('lname', lname);
            formData.append('email', email);
            formData.append('phone', phone);
            formData.append('questions', questions);
            formData.append('user_account_type', user_account_type);
            formData.append('social_media', social_media);

            formData.append('other_details', other_details);
            formData.append('other_social_details', other_social_details);

            // Fetch and response handling code... 
            fetch('./controllers/user-handler.php', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                return response.text()      
            })
            .then(response => {
                setTimeout(function() {
                    load_end();
                    console.log(response);

                    if($.trim(response) == '1') {
                        $('#message-response').html("<div class='success'>Success!</div>");
                    } else if($.trim(response) == '2') {
                        $('#message-response').html("<div class='error'>Email already exists</div>");
                    } else {
                        $('#message-response').html("<div class='error'>Error! Please try again</div>");
                    }
                }, 500);
            })
            .catch( err => console.log(err));
        } else {

            // Validation error handling code...
            // Account type validation
            if(user_account_type) {
                if (user_account_type === 'Other') {
                    if (!other_details) {
                        $('#errorAccountType').html('<div>Details for "Other" option are required</div>');
                        $('#account-type-wrapper').addClass('invalid'); // Adjust the wrapper selector
                    } else {
                        $('#errorAccountType').html('');
                        $('#account-type-wrapper').removeClass('invalid');
                    }
                } else {
                    $('#errorAccountType').html('');
                    $('#account-type-wrapper').removeClass('invalid');
                }
            } else {
                $('#errorSocial').html('<div>Required</div>');
                $('#social-media-wrapper').addClass('invalid'); // Adjust the wrapper selector
            }

            // Social media validation
            if(social_media) {
                if (social_media === 'other_social') {
                    if (!other_social_details) {
                        $('#errorSocial').html('<div>Details for "Other" option are required</div>');
                        $('#social-media-wrapper').addClass('invalid'); // Adjust the wrapper selector
                    } else {
                        $('#errorSocial').html('');
                        $('#social-media-wrapper').removeClass('invalid');
                    }
                } else {
                    $('#errorSocial').html('');
                    $('#social-media-wrapper').removeClass('invalid');
                }
            } else {
                $('#errorSocial').html('<div>Required</div>');
                $('#social-media-wrapper').addClass('invalid'); // Adjust the wrapper selector
            }

            // First name validation
            if (fname) {
                $('#errorFname').html('');
                $('#firstname-wrapper').removeClass('invalid'); // Adjust the wrapper selector
            } else {
                $('#errorFname').html('<div>Required</div>');
                $('#firstname-wrapper').addClass('invalid'); // Adjust the wrapper selector
            }

            // Last name validation
            if (lname) {
                $('#errorLname').html('');
                $('#lastname-wrapper').removeClass('invalid'); // Adjust the wrapper selector
            } else {
                $('#errorLname').html('<div>Required</div>');
                $('#lastname-wrapper').addClass('invalid'); // Adjust the wrapper selector
            }

            // Email validation
            if (email && email.match(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/)) {
                $('#errorEmail').html('');
                $('#email-wrapper').removeClass('invalid'); // Adjust the wrapper selector
            } else {
                if (email) {
                    $('#errorEmail').html('<div>Invalid email address</div>');
                    $('#email-wrapper').addClass('invalid'); // Adjust the wrapper selector
                } else {
                    $('#errorEmail').html('<div>Required</div>');
                    $('#email-wrapper').addClass('invalid'); // Adjust the wrapper selector
                }
            }

            // Phone validation (assuming it's optional)
            if (phone) {
                // Additional validation logic for phone if needed
                $('#errorPhone').html('');
                $('#phone-wrapper').removeClass('invalid'); // Adjust the wrapper selector
            } else {
                $('#errorPhone').html(''); // No error message for optional field
                $('#phone-wrapper').removeClass('invalid'); // Adjust the wrapper selector
            }

            // Questions validation
            if (questions) {
                $('#errorQuestion').html('');
                $('#questions-wrapper').removeClass('invalid'); // Adjust the wrapper selector
            } else {
                $('#errorQuestion').html('<div>Required</div>');
                $('#questions-wrapper').addClass('invalid'); // Adjust the wrapper selector
            }
        }
    }




    function handleRadioSelection(label) {
        const radioInput = label.previousElementSibling;
        const radios = label.closest('.radios');
        const allLabels = radios.querySelectorAll('.radio-label');

        // Unselect all labels
        allLabels.forEach((label) => {
            label.classList.remove('selected');
            label.previousElementSibling.checked = false;
        });

        // Select the clicked label
        label.classList.add('selected');

        // Update the radio input's checked property
        radioInput.checked = true;
    }
</script>


</body>
</html>