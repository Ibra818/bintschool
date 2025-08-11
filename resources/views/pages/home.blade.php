@extends('index')

@section('content')
    <style>
        :root{
            --primary:rgba(5,7,21,255);
            --border: #222430;
            --block: rgba(27, 29, 50, 1);
            --lite: rgba(197, 199, 222, 1);
            --secondary: #1B1B1B;
            --graylite: #353535ff;
            --green: #5ede50ff;
        }
        html,body{
            height:100%;
        }

        main{
            position:fixed;
            top:0;
            height:100%;
        }

        #blockpage{
            display:flex;
            position:relative;
            flex: 10;
        }

        nav{
            position:sticky;
            background-color: var(--primary);
            color: white;
            height:100%;
            width:20%;
            display: flex;
            flex-direction: column;
            justify-content: space-around;
            align-items: space-evenly;
            padding: 0 0 1% 0;
            color: var(--lite); 
            min-height:100%;
            flex:2;
        }
        
        nav img{
            width: 60%;
            margin: 0 0 0 10%;
        }

        nav .pages{
            height: 70%;
        }
        nav ul{
            color: orange;
            height:100%;
            display:flex;
            flex-direction: column;
            justify-content: flex-start;
        }

        nav ul li{
            color: var(--lite);
            background-color: var(--border);
            height: 8%;
            width:85%;
            font-weight: 500;
            font-size: 1.15em;
            display:flex;
            justify-content: flex-start;
            align-items: center;
            border-radius:10px;
            padding: 0 0 0 5%;
            margin: 5% 0 2% 0;
            cursor:pointer;
            list-style-type: none;
            position:relative;
            transition: all .5s ease;
            
        }

        nav ul li.forma-suivie svg{
            fill:transparent;
            stroke:white;
        }

        nav ul li.active{
            padding: 0 0 0 10%;
            color:orange;
            border:1px solid orange;
            transition: all .5s ease;
        }

        nav ul li.active::before{
            content: '';
            position:absolute;
            left: 5%;
            width: 5px;
            height: 5px;
            border-radius: 50px;
            background-color:orange;
        }

        nav ul li svg{
            width:25px;
            height:25px;
            fill:white;
            stroke:transparent;
            margin: 0 5% 0 0;
        }

        #logout{
            margin: 0 5% 0 5%;
            padding: 0 0 0 5%;
            border-radius: 10px;
            background-color: var(--block);
            height: 5vh;
            color: var(--lite);
            border:none;
            display: flex;
            justify-content: flex-start;
            align-items: center;
            gap: 5%;
            font-size: 1.1em;
        }

        #logout svg{
            width: 30px;
            height:30px;
            fill: var(--lite);
        }

        #home{
            display:flex;
            background-color: var(--secondary);
            flex:10;
            z-index: 2;
            padding: 0% 0 2% 0;
        }

        #home #categories ul{
            color: orange;
            display:flex;
            flex-direction: column;
            justify-content: space-between;
            width:90%;
            height:100%;
            padding: 10% 0 5% 5%;
            overflow-y: scroll;
            overflow-x: hidden;
            scroll-behavior: smooth;
            scrollbar-width:none;
        }

        #categories ul li{
            width:100%;
            color: #797979ff;
            list-style-type: none;
            cursor:pointer;
            margin: 0 0 0 10%;
            position: relative;
        }

        #categories ul li.active{
            color: white;
        }

        #home #categories ul li.active::before{
            background-color:orange;
            transition: background-color .5s ease;
            width:10px;
            height:20px;
        }
        
        #home #categories ul li::before{
            content: '';
            transition: background-color .5s ease;
            position: absolute;
            left:-10%;;
            border-radius: 10px;
            margin: 0 20% 0 0;
            width:10px;
            height:20px;
            background-color:white;
        }

        #categories{
            flex:2;
            overflow: hidden;
        }


        #home aside{
            flex:3;
            display:flex;
            flex-direction: column;
            justify-content:space-between;
            align-items: center;
        }

        #home aside .search{
            width: 85%;;
            display:flex;
            justify-content: space-between;
            align-items: center;
            margin: 5% 0 0 0;
        }

        #home aside .search .input-container{
            display:flex;
            justify-content:space-around;
            align-items:center;
            border-radius:15px;
            width: 73%;
            height: 6vh;
            padding: 0 0 0 4%;
            border:2px solid #8a8a8aff;
        }

        #home aside .search .input-container input{
            background-color: var(--secondary);
            border:none;
            width:80%;
            height:90%;
            color:white;
        }

        #home aside .search .input-container input:focus{
            outline:none;
            color:white;
        }

        #home aside .search .btn-search{
            height:100%;
            border-radius: 10px;
            font-weight:400;
            background-color: orange;
        }

        #home aside .search .input-container svg{
            fill:white;
            width:25px;
            height:25px;
        }

        #suggestions{
            height:100%;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 5%;
            align-items: center;
            overflow-y: scroll;
            overflow-x: hidden;
            margin: 5% 0 0 0;
            scrollbar-width:none;
            scroll-behavior: smooth;
        }

        #suggestions .video{
            width: 40%;
            height:45%;
            border-radius: 10px;
            border: 1px solid white;
            margin: 0 0 3% 0;
            position:relative;
        }

        #suggestions .video svg{
            fill:white;
            height:50px;
            width:50px;
            position:absolute;
            top:40%;
            left:35%;
            z-index: 2;
        }

        #content{
            overflow-y: scroll;
            scrollbar-width:none;
            scroll-behavior: smooth;
            padding: 1% 0 0 0;
            flex:3;
        }

        #content .content-item{
            position:relative;
        }

        #content .content-item .text, #content .content-item video{
            position:absolute;
        }
        #content .content-item{
            width: 100%;
            height:90%;
            border-radius: 20px;
            overflow: hidden;
            margin: 5% 0 0 0;
        }

        #content .content-item .text{
            background: linear-gradient(to top, var(--primary), transparent);
            color:white;
            z-index:2;
            height:35%;
            width: 100%;
            bottom:10%;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            
        }
        
        #content .content-item video{
            width:100%;
            height:90%;
            object-fit:cover;
        }

        #content .content-item .text .user{
            height: 25%;
            width: 80%;
            display:flex;
            flex-direction: row;
            gap:5%;
            justify-content: flex-start;
            align-items: center;
            margin: 0 0 1% 5%;
        }

        #content .content-item .text .user .btn-follow{
            font-size: 1.1em;
        }

        #content .content-item .text .user button{
            border:none;
            opacity: .7;
            padding: 1% 2% 1% 2%;
            border-radius: 5px;
            background-color:white;
        }

        #content .content-item .text .user .info{
            max-height: 100%;
            display:flex;
            flex-direction: column;
            justify-content: space-evenly;
            align-items: center;
        }
        #content .content-item .text .user img{
            width: 15%;
            height:100%;
            object-fit:cover;
            border-radius:50px;
        }

        #content .content-item .text p{
            max-height:5vh;
            max-width:85%;
            padding: 0 0 0 5%;
            overflow:hidden;
            font-size: .8em;
        }

        #content .content-item .text .btns{
            width: 40%;
            height:20%;
            max-width:40%;
            max-height:20%;
            display:flex;
            flex-direction: row;
            justify-content: space-around;
            align-items: center;
            margin: 0 0 0 55%;
        }

        #content .content-item .text .btns button{
            width: 30%;
            height:90%;
            max-height:90%;
            backdrop-filter:  blur(1px);
            background-color:transparent;
            border:none;
        }

        #content .content-item .text .btns button svg{
            fill:white;
            width:25px;
            height:25px;
        }

        #content .content-item .text .btns button::before{
            background-color:white;
            opacity: 0.5;
            content: '';
        }


        #content .content-item .text .more{
            max-height: 30%;
            position:absolute;
            bottom: 0;
            display:flex;
            justify-content: space-around;
            align-items: center
        }

        #content .content-item .text .more p{
            max-width: 50%;
            overflow:hidden;
            margin: 2% 0 2% 0;
            padding: 0 0 0 0;
        }

        #content .content-item .text .more button{
            background-color:orange;
            border:none;
            width:20%;
            height: 5vh;
            border-radius: 5px;
            color:black;
        }

        #content .content-item .pause svg{
            position:absolute;
            top:35%;
            left:40%;
            fill:white;
            width:100px;
            height:100px;
            
        }

        #content .content-item .pause.active{
            opacity: 1;
            transition: opacity .5s ease;
        }

        #content .content-item .pause.unactive{
            opacity: 0;
            transition: opacity .5s ease;
        }

        #profile, #home, #cour-details{
            height:100%;
            position: absolute;
        }

        #profile{
            color:white;
            background-color: var(--secondary);
            width: 0%;
            padding: 5% 10% 0 10%;
            transform: translateX(110%);
            transition: transform .5s ease;
            overflow-y: scroll;
            scroll-behavior: smooth;
            scrollbar-width:none;
        }

        #profile.active{
            width: 100%;
            z-index:5;
            transform: translateX(0);
            transition: transform .5s ease;
        }


        #profile .user{
            height: 70%;
            max-height:70%;
            position:relative;
            padding: 0 0 5% 0;
            border-bottom: 2px solid gray;
        }

        #profile .user .cover{
            height:35vh;
            border-radius: 20px;
            overflow: hidden;
        }

        #profile .user .cover img{
            height:100%;
            width:100%;
            object-fit:cover;
        }

        #profile .user .user-profile{
            display:flex;
            justify-content: space-between;
            height:55%;
            position:absolute;
            bottom: 1%;
        }

        #profile .user .user-profile .user-info{
            display:flex;
            flex-direction: column;
            justify-content: space-between;
            height:100%;
            padding: 0 0 0 3%;
            flex:3;
        }

        #profile .user .user-profile .user-info img{
            border:5px solid white;
            height:40%;
            width:20%;
            border-radius: 50%;
            object-fit: cover;
        }

        #profile .user .user-profile .user-info p{
            overflow:hidden;
            max-height:5vh;
            width:65%;
        }

        #profile .user .user-profile .followers{
            font-size:1.1em;
            font-weight:500;
            width: 100%;
            height:5vh;
            display: flex;
            justify-content: space-evenly;
            align-items: center;
        }

        #profile .user .user-profile .followers span{
            color: gray;
        }

        #profile .user .user-profile .btns{
            flex:2;
            display:flex;
            justify-content: space-between;
            align-items: center;
        }

        #profile .user .user-profile .btns button{
            border:none;
            width:30%;
            height:15%;
            font-size:1em;
            font-weight:500;
            border-radius:5px;
        }

        #profile .complete-profil{
            height:40%;
            display:flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: space-between;
            padding: 2% 0 5% 0;
            border-bottom: 2px solid gray;
        }


        #profile .complete-profil .block1, #profile .complete-profil .block2 {
            display:flex;
            justify-content: space-between;
            align-items:center;
            padding: 0% 1% 0 1%;
        }

        #profile .complete-profil .block1, #profile .complete-profil .block2 .block2-item{
            width:50%;
            height:100%;
            display: flex;
            justify-content: space-around;
            align-items: center;
        }

        #profile .complete-profil .block1{
            height:70%;
            width:100%;
            border-radius: 20px;
            margin: 0 0 2% 0;
            padding: 1% 1% 1% 1%;
            background-color: var(--graylite);
        }

        #profile .complete-profil .block1 .congratulations{
            border:1px solid gray;
            padding: 1% 0 0 0;
            height:100%;
            width: 25%;
            text-align:center;
            border-radius:15px;
        }

        #profile .complete-profil .block1 .congratulations h4{
            font-size: 1em;
            width: 100%;
            display: flex;
            justify-content: space-evenly;
            align-items: center;
        }

        #profile .complete-profil .block1 .congratulations p{
            font-size: .8em;
        }

        #profile .complete-profil .block1 .congratulations svg{
            height:40px;
            width:40px;
            fill:white;
            border-radius:100px;
            background-color: var(--green);
            box-shadow: rgba(0, 0, 0, 1);
         }

        #profile .complete-profil .block2{
            border: 5px solid #4285F4;
            background-color: #4481e42b;
            border-radius: 20px;
            height:35%;
            position:relative;
        }


        #profile .complete-profil .block2 svg{
            height:50px;
            width:50px;
            fill: #4285F4;
        }

        #profile .complete-profil .block2 .send-link{
            width: 80%;
            padding: 1% 0 0 0;
            display:flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;
        }

        #profile .complete-profil .block2 .send-link h4{
            font-size: 1.1em;
        }

        #profile .complete-profil .block2 .send-link .link-mail{
            display:flex;
            justify-content: space-around;
            width:90%;
        }

        #profile .complete-profil .block2 .send-link a{
            color: orange;
        }

        #profile .complete-profil .block2 button{
            height:70%;
            border: none;
            font-size: 1em;
            font-weight:500;
            border-radius: 10px;
        }

        #profile .complete-profil .percentage{
           width: 8%;
           height:10vh;
           border-radius: 100px;
           background: conic-gradient(var(--green) 80%, black 20%);;
           display:flex;
           justify-content: center;
           align-items: center;
        }

        #profile .complete-profil .percentage::before{
           content: '90%';
           font-size: 1.2em;
           display: flex;
           justify-content: center;
           align-items: center;
           padding: 10%;
           height:80%;
           width:80%;
           border-radius: 50%;
           background-color: var(--secondary);
        }

        #profile .complete-profil .block1 .checkboxs{
            width: 65%;
            height:100%;
            gap: 10%;
            display:flex;
            flex-direction: column;
            justify-content: center;
        }

        #profile .complete-profil .block1 .checkboxs h2{
            width:100%;
            padding: 0 0 0 5%;
            font-size:1.5em;
        }

        #profile .complete-profil .block1 .checkboxs .checks{
            display:flex;
            width:100%;
            gap:1%;
        }

        #profile .complete-profil .block1 .checkboxs .checks .check-item{
            display:flex;
            width:33%;
            justify-content: space-evenly;
            align-items: center;
            font-size:.8em;
        }

        #profile .complete-profil .block1 .checkboxs .checks .check{
            width: 30px;
            height:30px;
            margin: 0 1% 0 0;
            display:flex;
            justify-content: flex-start;
            background-color: var(--green);
            border-radius:50px;
        }

        #profile .complete-profil .block1 .checkboxs .checks .check svg{
            height:100%;
            width:100%;
            fill: green;
        }

        #profile .complete-profil .center .checks-profil .checkboxs{
            display:flex;
        }

        #cours{
            width: 100%;
            margin: 2% 0 0 0;
            display:flex;
            flex-direction: column;
            justify-content: space-between;
        }

        #cours .items{
            width:100%;
            height:30vh;
            display: flex;
            align-items:Center;
            flex-wrap: wrap;
            gap: 5%;
        }

        #cours ul{
            display: flex;
            justify-content: space-between;
            align-items:center;
            width:60%;
        }

        #cours ul li{
            font-size: 1.1em;
            font-weight: 500;
            list-style-type: none;
            text-align:center;
            height: 4vh;
            width:30%;
            cursor: pointer;
            padding: 1% 0 0 0;
            background-color: transparent;
            transition: backgroun-color .5s ease;
        }

        #cours ul li.active{
            border-radius: 15px;
            background-color: var(--graylite);
            transition: backgroun-color .5s ease-out;
        }

        #cours .cour{
            display:flex;
            justify-content: space-around;
            align-items: center;
            width: 45%;
            height:12vh;
            cursor: pointer;
            border-radius: 20px;
            background-color: var(--graylite);
            margin: 5% 0 0 0;
            padding: 0 0 0 1%;
        }

        #cours .cour img{
            flex:2;
            height:80%;
            border-radius: 10px;
            object-fit: cover;
        }

        #cours .cour .text{
            flex:6;
            display:flex;
            flex-direction: column;
            justify-content: space-around;
        }

        #cours .cour .text h4{
            width:100%;
            padding: 0 0 0 5%;
        }

        #cours .cour .text .meta-info{
            display:flex;
            justify-content: space-around;
            align-items: flex-end;
            width: 100%;
            color: gray;
        }

        #cours .cour .text .meta-info .hour{
            box-shadow: 0 0 10px 0 rgba(0, 0, 0, .5);
            text-align:center;
            width:20%;
            border-radius: 50px;
        }

        #cours .cour .text .meta-info .cour-cate{
            width:20%;
            text-align: center;
            border-radius: 50px;
            box-shadow: 0 0 10px 0 rgba(0, 0, 0, .5);
        }

        #cours .cour .text .meta-info .publisher{
            box-shadow: 0 0 10px 0 rgba(0, 0, 0, .5);
            border-radius: 50px;
            display:flex;
        }

        #cours .cour .text .meta-info .publisher img{
            width:30%;
            height:10%;
            border-radius: 100px;
            object-fit:cover;
        }

        #inputs{
            width:0;
            height:0;
        }

        #profile-pic, #cover-pic{
            display:none;
        }

        #overlay{
            height:0;
            width:0;
            z-index: -1;
            transition: height .5s ease;
            overflow: hidden;
            z-index: 1000000;
        }

        #overlay.active{
            position:fixed;
            top:0;
            height:100%;
            width: 100%;
            z-index: 6;
            background-color: rgba(0, 0, 0, .5);
            transition: height .5s ease;
            display: flex;
            justify-content: flex-end;
            padding: 0 17% 0 0;
        }

        #overlay.del-acc{
            position:fixed;
            top:0;
            height:100%;
            width: 100%;
            padding: 0 25% 0 0;
            background-color: rgba(0, 0, 0, .7);
            transition: height .5s ease;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        #params{
            width: 0;
            height:0; overflow: hidden;
        }

        #params.active{
            height:100%;
            width:30%;
            transform: translateX(110%);
            transition: transform .5s ease;
            background-color: var(--secondary);
        }

        #params.active .body{
            width: 100%;
            height:100%;
            position:relative;
        }

        #params.active .body .btns, #params .body .del-reasons{
            position:absolute;
        }

        .del-reasons{
            width: 0%;
            height: 0%;
            z-index: 0;
            overflow: hidden;
            display:flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items:center;
            transform: translateX(110%);
            transition: transform .5s ease-out;
        }
        

        #params.active .body .del-reasons.active{
            width: 100%;
            height: 90%;
            max-height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: center;
            background-color: var(--secondary);
            color: white;
            transform: translateX(0%);
            z-index: 2;
            transition: transform .5s ease-out;
        }

        #params.active .body .del-reasons.active p, #params .body .del-reasons.active h3{
            width: 100%;
            display:flex;
            justify-content: flex-start;
        }

        #params.active .body .del-reasons.active p{
            color:gray;
        }

        #params.active .body .del-reasons.active form{
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items:center;
            width:100%;
        }

        #params.active .body .del-reasons.active form label{
            width: 100%;
            margin: 0 0 2% 0;
            padding: 0 0 0 3%;
            display: flex;
            justify-content: flex-start;
        }

        #params.active .body .del-reasons.active form textarea{
            border:none;
            height: 20vh;
            width:95%;
            color: white;
            border-radius: 10px;
            border: 2px solid gray;
            background-color: transparent;
        }

        #params.active .body .del-reasons.active form textarea:focus{
            outline: none;
        }

         #params.active .body .del-reasons.active .foot{
            width:100%;
            height: 10%;
            border-top: 2px solid var(--graylite);
            display:flex;
            justify-content: space-around;
            align-items:center;
            padding: 15% 0 0 0;
            margin: 60% 0 0 0;
         }

        #params.active .body .del-reasons.active .foot button{
            width: 45%;
            height:5vh;
            border:none;
            border-radius: 10px;
        }

        #params.active .body .del-reasons.active .foot button:nth-child(1){
            background-color: var(--graylite);
            color: white;
        }

        #params.active .body .del-reasons.active .foot button:nth-child(2){
            background-color: white;
            color: black;
        }

        #params.active{
            height:100%;
            width:40%;
            padding: 0 0 0 2%;
            background-color: var(--secondary);
            transform: translateX(0);
            transition: transform .5s ease;
        }

        #params.active .param-head{
            width:100%;
            height:8%;
            color:white;
            border-bottom: 1px solid var(--graylite);
            display:flex;
            justify-content: space-between;
            align-items: center;
            margin: 0 0 5% 0;
            transition: width .5s ease;
            position: relative;
        }
        

        #params.active .param-head .par-head-block1{
            width:100%;
            height:100%;
            color:white;
            display:flex;
            justify-content: space-between;
            align-items: center;
        }

        #params.active .param-head.active .par-head-block1{
            width:0%;
            height:0%;
            z-index: -1;
            overflow:hidden;
        }

        #params.active .param-head .par-head-block2{
            z-index: -1;
            width:0%;
            height:0%;
            overflow: hidden;
            background-color: var(--secondary);
            transform: translateX(110%);
        }
        

        #params.active .param-head .par-head-block1, #params.active .param-head .par-head-block2{
            position: absolute;
        }

        #params.active .param-head .par-head-block1{
            z-index: 1;
        }

        #params.active .param-head.active .par-head-block2{
            width:100%;
            height:100%;
            z-index: 2;
            color:white;
            display:flex;
            justify-content: space-between;
            align-items: center;
            transform: translateX(0%);
            transition: transform .5s ease;
        }

        #params.active .param-head.active .par-head-block2{

        }
    

        #params.active .param-head .par-head-block1 .btn-close-param{
            background-color: var(--graylite);
            border-radius: 50%;
            width:10%;
            height:60%;
            display: flex;
            justify-content: center;
            align-items: center;
            border:none;
        }

        #params.active .param-head.active .bi.bi-chevron-left{
            height:30px;
            width: 30px;
            fill: white;
            border-radius: 50%;
            background-color: var(--graylite);

        }

        #params.active .param-head .btn-close-param svg{
            height:100%;
            width:85%;
            fill:white;
        }

        #params.active .btns{
            height: 100%;
            width: 100%;
            display: flex;
            flex-direction: column;
            justify-content:flex-start;
            align-items: center;
            gap: 5%;

        }
        #params.active .btns .info-perso .btn-info-perso, #params.active .btns .ctn-dev-forma .btn-dev-forma, #params.active .btns .ctn-del-acc .btn-del-acc{
            width: 95%;
            height: 100%;
            max-height:100%;
            color: white;
            border:none;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-radius: 10px;
            font-size: 1.1em;
            font-weight: 400;
            background: var(--graylite);
            transform: height .5s ease-out;
        }

        #params.active .btns .info-perso.active .btn-info-perso,  #params.active .btns .ctn-dev-forma .btn-dev-forma, #params.active .btns .ctn-del-acc .btn-del-acc{
            width: 95%;
            height: 5vh;
            max-height:5vh;
            color: white;
            border:none;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-radius: 10px;
            font-size: 1.1em;
            background: var(--graylite);
            transform: height .5s ease-out;
        }

        #params.active .btns .info-perso form{
            width: 0;
            height: 0;
            overflow: hidden;
        }
        #params.active .btns button svg{
            height:25px;
            width: 25px;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 15px;
            fill:white;
        }

        #params.active .btns .info-perso{
            width:100%;
            height: 5vh;
            max-height: 5vh;
            transition: height .5s ease-out;
        }
        #params.active .btns .info-perso.active{
            height: 40%;
            max-height: 50%;
            transition: height .5s ease-out;
        }

        #params.active .btns .info-perso .btn-info-perso svg{
            transform: rotate(90deg);
            transition: transform .5s ease;
        }

        #params.active .btns .info-perso.active button svg{
            transform: rotate(-90deg);
            transition: transform .5s ease;
        }

        #params.active .btns .info-perso.active form{
            height: 100%;
            width:100%;
            display: flex;
            flex-direction: column;
            justify-content: space-evenly;
            align-items: center;
        }

        #params.active .btns .info-perso.active form button{
            width:30%;
            height:5vh;
            font-size: 1.1em;
            font-weight: 500;
            color:white;
            border:none;
            border-radius: 10px;
            margin: 0 0 5% 0;
            background-color: orange;
        }


        #params.active .btns .info-perso.active form .ctn-input{
            border:0px solid white;
            background-color: var(--graylite);
            display: flex;
            justify-content: space-between;
            padding: 0 0 0 2%;
            align-items: center;
            height:15%;
            width: 80%;
            border-radius: 15px;
        }

        #params.active .btns .info-perso.active form .ctn-input input::placeholder{
            color:white;
            text-align: center;
        }

        #params.active .btns .info-perso.active form .ctn-input input{
            border:none;
            color:white;
            width: 90%;
            height: 100%;
            padding: 0 0 0 2%;
            background-color: transparent;
        }

        #params.active .btns .info-perso.active form .ctn-input input:focus{
            outline: none;
        }

        #params.active .btns .info-perso.active form .ctn-input svg{
            width:30px;
            height: 30px;
            fill: white;
        }

        #params.active .btns .ctn-dev-forma , #params .btns .ctn-del-acc{
            height:5vh;
            width: 100%;
        }

        @keyframes fadeInUp{
            from{translateY(-100%); }
            to{translateY(0%); opacity:1;}
        }

        #del-acc-msg{
            width: 0;
            height:0;
            overflow: hidden;
        }

        #del-acc-msg.active{
            width: 400px;
            height:400px;
            border-radius: 20px;
            z-index: 1000;
            display:flex;
            gap: 1%;
            flex-direction:column;
            justify-content: space-evenly;
            align-items:space-around;
            padding: 1% 2% 0 2%;
            background-color: var(--secondary);
            animation: fadeInUp .5s ease-out;
        }

        #del-acc-msg.active .del-acc-head{
            width: 100%;;
            display:flex;
            flex-direction: column;
            justify-content:space-around;
            align-items:flex-start;
            color:white;
        }

        #del-acc-msg.active .del-acc-head svg{
            height:40px;
            width: 40px;
            fill : white;
            display:flex;
            margin: 0 0 1% 0;
            justify-content:Center;
            align-items:center;
            border-radius: 50%;
            background-color: red;
        }


        #del-acc-msg.active form{
            width:100%;
            height: 45%;
            gap: 5%;
            display:flex;
            flex-direction: column;
            justify-content:space-between;
            align-items:space-around;
        }

        #del-acc-msg.active label{
            color:white;
        }

        #del-acc-msg.active input{
            border:none;
            height: 5vh;
            max-height: 5vh;
            width:100%;
            border-radius: 10px;
            border: 2px solid var(--graylite);
            background-color: transparent;
        }

        #del-acc-msg.active input:focus{
            outline:none;
            color:white;
        }

        #del-acc-msg.active .btn-del-acc-msg{
            width: 100%;
            height: 5vh;
            border:none;
            color:white;
            border-radius: 10px;
            background-color: #da2525ff;;
        }

        .btn-del-acc-return{
            width:100%;
            z-index:2; 
            height: 100%; 
            display: flex;
            justify-content: flex-start;
            align-items: center;
            gap: 5%;
            border: none;
            color: white;
            background-color: var(--secondary);
        }

        #switch-acc{
            width:0;
            height:0;
            overflow: hidden;
            transition: height .5s ease-out;
        }

        #switch-acc.active{
            width: 400px;
            height:500px;
            border-radius: 20px;
            z-index: 1000;
            display:flex;
            gap: 1%;
            flex-direction:column;
            justify-content: space-evenly;
            align-items:space-around;
            padding: 1% 2% 0 2%;
            background-color: var(--secondary);
            animation: fadeInUp .5s ease-out;
            color:white;
        }

        #switch-acc.active .switch-acc-head{
            display:flex;
            flex-direction:column;
            justify-content: space-around;
            align-items: center;
        }
        #switch-acc.active .switch-acc-head p{
            color: gray;
        }

        #switch-acc.active .switch-acc-advantages{
            background-color: #47bf2f28;
            display:flex;
            flex-direction: column;
            justify-content: space-around;
            align-items: space-around;
            border-radius: 20px;
        }

        #switch-acc.active .switch-acc-advantages h4{
            width: 100%;
            color: white;
            display:flex;
            justify-content: space-between;
            align-items: flex-start;
        }

        #switch-acc.active .switch-acc-advantages .advantage-item{
            display:flex;
            justify-content: justify;
            align-items: space-evenly;
            color: var(--green);
        }
        #switch-acc.active .switch-acc-advantages .advantage-item svg{
            fill: var(--green);
            height:30px;
            width: 30px;
            display:flex;
            justify-content: center;
            align-items: center;
        }

        #switch-acc.active .switch-acc-btn-ctn{
            width: 100%;
            height:5vh;
            color:var(--secondary);
            display:flex;
            justify-content: center;
            align-items: center;
            border:none;
            border-radius: 20px;
            background-color: orange
        }

        #cour-details{
            width: 0;
            height:0;
            transform: translateX(110%);
            overflow: hidden;
            transition: width .5s ease-out;
        }
        #cour-details.active{
            width: 100%;
            height:100%;
            z-index: 10;
            display:flex;
            align-items: space-around;
            background-color: var(--secondary);
            transform: translateX(0);
            transition: transform .5s ease-out;
            position: relative;
        }

        #cour-details.active .cour-detail-body, #cour-details.active #sell-cour-detail-overlay{
            position: absolute;
        }

        #cour-details.active .cour-detail-body{
            width: 100%;
            height:100%;
            display:flex;
            z-index: 11;
            align-items: space-around;
            background-color: var(--secondary);
            transform: translateX(0);
            transition: transform .5s ease-out;
        }

        #cour-details .container-left{
            width: 25%;
            display:flex;
            flex-direction: column;
            justify-content: justify;
            align-items: center;
            padding:2% 0 0 0;
        }
        #cour-details.active .container-left button{
            color:white;
            width: 75px;
            height: 3vh;
            display: flex;
            justify-content: space-around;
            align-items: center;
            border: 1px solid gray;
            border-radius: 10px;
            background-color: var(--graylite);
        }

        #cour-details.active .container-left button svg{
            height:90%;
            width: 30%;
            fill: white;
        }
        #cour-details.active .container-right{
            overflow-y: scroll;
            scroll-behavior: smooth;
            scrollbar-width: none;
            padding:5% 0 0 0;
            display: flex;
            justify-content: space-around;
            align-items: center
        }
        #cour-details.active .container-right .cdtls-block1{
            width: 45%;
            height: 100%;
            display:flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
        }
        #cour-details.active .container-right .cdtls-block1 img{
            width: 90%;
            height:60%;
            border-radius: 20px;
            object-fit: cover;
        }
        #cour-details.active .container-right .cdtls-block2{
            color: white;
            height:100%;
            padding: 0 0 0 2%;
            overflow-y: scroll;
            scrollbar-width: none;
        }

        #cour-details.active .container-right .cdtls-block2 .cour-intro .cour-cat{
            color: gray;
            width: 20%;
            display: flex;
            justify-content: space-around;
        }

         #cour-details.active .container-right .cdtls-block2 .cour-intro{
            width: 90%;
            height: 50%;
            display:flex;
            flex-direction: column;
            justify-content: space-around;
            align-items: space-around;
            margin: 0 0 5% 0;
            border-bottom: 2px solid gray;
         }

          #cour-details.active .container-right .cdtls-block2 .cour-intro .stars{
            border: 1px solid orange;
            height:3vh;
            width: 25%;
            display: flex;
            justify-content: space-around;
            align-items: center;
            overflow: hidden;
          }

          #cour-details.active .container-right .cdtls-block2 .cour-intro .stars svg{
            width: calc(100%/5);
            height: 90%;
            fill: orange;
          }

          #cour-details.active .container-right .cdtls-block2 .cour-intro .cour-reactions{
            width:35%;
            height: 6vh;
            display: flex;
            justify-content: space-around;
            align-items: center;
          }

          #cour-details.active .container-right .cdtls-block2 .cour-intro .cour-reactions button{
            border:1px solid white;;
            height:100%;
            width: 27%;
            border: none;
            border-radius: 15px;
            background-color: var(--graylite);
            display: flex;
            justify-content: center;
            align-items: center;
          }

          #cour-details.active .container-right .cdtls-block2 .cour-intro .cour-reactions svg{
            height: 60%;
            width: 60%;
            fill: white;
          }

        #cour-details.active .container-right .cdtls-block2 .cour-intro .cour-formateur{
           width: 55%;
           height: 20%;
           display:flex;
           justify-content: space-between;
           align-items: center;
        }

        #cour-details.active .container-right .cdtls-block2 .cour-intro .cour-formateur .formateur-info{
            height:90%;
            width: 100%;
            display:flex;
            justify-content: space-around;
            align-items: center;
        }

        #cour-details.active .container-right .cdtls-block2 .cour-intro .cour-formateur .formateur-info .visiter{
            display:flex;
            justify-content: space-around;
            align-items: center;
        }

        #cour-details.active .container-right .cdtls-block2 .cour-intro .cour-formateur .formateur-info .visiter svg{
            fill: white;
            width: 25px;
            height: 90%;
        }

        #cour-details.active .container-right .cdtls-block2 .cour-intro .cour-formateur img{
            width: 17%;
            height:100%;
            object-fit: cover;
            border-radius: 50%;
            border:1px solid white;
        }

        #cour-details.active .container-right .cdtls-block2 .cour-intro .cour-formateur .formateur-info .formateur{
            display:flex;
            flex-direction: column;
            justify-content: space-around;
            align-items: justify;
        }

        #cour-details.active .container-right .cdtls-block2 .cour-intro .cour-formateur button{
            border: 1px solid gray;
            color: white;
            width: 20%;
            border-radius: 10px;
            background-color: var(--graylite);
        }

        #cour-details.active .container-right .cdtls-block2 .cour-intro .cour-formateur button svg{}

        /* #cour-details.active .container-right .cdtls-block2 .cour-body{} */
        #cour-details.active .container-right .cdtls-block2 .cour-body .a-propos{
            border-bottom: 2px solid gray;
            padding: 0 0 5% 0;
            width: 90%;
            height: 40%;
            display: flex;
            flex-direction: column;
            justify-content: space-around;
            align-items: flex-start;

        }
        #cour-details.active .container-right .cdtls-block2 .cour-body .a-propos h3 {
            color: white;
            margin: 0 0 2% 0;
            font-size: 1.6em;
            font-weight: 500;
        }

        #cour-details.active .container-right .cdtls-block2 .cour-body .a-propos p{
            color: gray;
            width: 90%;
        }

        #cour-details.active .container-right .cdtls-block2 .cour-body .a-propos .acces{
            display: flex;
            height: 5%;
            border: 1px solid var(--green);
            width: 20%;
            border-radius: 10px;
            justify-content: space-between;
            align-items: center;
            border: none;
            background-color: transparent;
            color: white;
            color: var(--green);
        }

        #cour-details.active .container-right .cdtls-block2 .cour-body .a-propos .acces svg{
            fill: var(--green);
            height: 30px;
            width: 30%;
        }
        #cour-details.active .container-right .cdtls-block2 .cour-body .btns{
            display:flex;
            justify-content: space-around;
            align-items: center;
            height: 6vh;
            width:90%;
            margin: 2% 0 2% 0;
        }
        #cour-details.active .container-right .cdtls-block2 .cour-body .btns button{
            border:none;
            width: 30%;
            height: 95%;
            border-radius: 15px;
            background-color: var(--graylite);
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            font-size: 1.2em;
        }

        #cour-details.active .container-right .cdtls-block2 .cour-body .btns button svg{
            width: 25%;
            height: 60%;
            fill: orange;
        }

        #cour-details.active .container-right .cdtls-block2 .cour-body .btns button:nth-child(1) svg{
            rotate: 45deg;
        }

        #cour-details.active .container-right .cdtls-block2 .cour-body .cour-chapters{
            margin: 5% 0 0 0;   
        }

        #cour-details.active .container-right .cdtls-block2 .cour-body .cour-chapters h3{
            color: white;
            margin: 0 0 2% 0;
            font-size: 1.5em;
            font-weight: 500;
        }
        #cour-details.active .container-right .cdtls-block2 .cour-body .cour-chapters .chapters-items{
            display: flex;
            flex-direction: column;
            align-items: space-around;
        }
        #cour-details.active .container-right .cdtls-block2 .cour-body .cour-chapters .chapters-items .item {
            max-width: 90%;
            height:5vh;
            padding: 0 0 0 2%;
            margin: 1% 0 1% 0;
            color: var(--green);
            display: flex;
            gap: 1.5%;
            justify-content: justify;
            align-items: center;
            font-size: 1.2em;
        }
        #cour-details.active .container-right .cdtls-block2 .cour-body .cour-chapters .chapters-items .item button{
            border:none;
            height: 80%;
            width: 5%;
            border-radius: 10px;
            background-color: var(--green);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        #cour-details.active .container-right .cdtls-block2 .cour-body .cour-chapters .chapters-items .item button svg{
            fill: green;
        }

        #cour-details.active .container-right .cdtls-block2 .cour-body .cour-content{
            display: flex;
            flex-direction: column;
            justify-content: space-around;
            padding: 0 0 0 2%;
            margin: 5% 0 0 0; 
            width: 90%;
        }

        #cour-details.active .container-right .cdtls-block2 .cour-body .cour-content .part{
            color: gray;
            font-size: 1.1em;
            margin: 2% 0 2% 0;
            width: 100%;
        }


        #cour-details.active .container-right .cdtls-block2 .cour-body .cour-content .content-items{
            color: white;
            margin: 2% 0 0 0;
        }
        
        #cour-details.active .container-right .cdtls-block2 .cour-body .cour-content .content-items .item{
            height: 6vh;
            width: 100%;
            display: flex;
            justify-content: space-around;
            align-items: center;
        }

        #cour-details.active .container-right .cdtls-block2 .cour-body .cour-content .content-items .item div{
            width: 100%;
            height: 100%;
            border-bottom: 1px solid gray;
            display:flex;
            justify-content: baseline;
            align-items: center;
            border-radius: 10px;
            background-color: var(--graylite);
            gap: 10%;
            padding: 0 0 0 2%;
        }

        #cour-details.active .container-right .cdtls-block2 .cour-body .cour-content .content-items .item div svg:nth-child(2){
            margin: 0 0 0 55%;
        }

        #cour-details.active .container-right .cdtls-block2 .cour-body .cour-content .content-items .item button{
            border-radius: 10px;
            height: 60%;
            width: 5%;
            border: none;
            background-color: var(--secondary);
        }

        #cour-details.active .container-right .cdtls-block2 .cour-body .cour-content .content-items .item button svg{
            fill: white;
        }

        #cour-details.active .container-right .cdtls-block2 .cour-body .public-cible{
            padding: 0 0 0 5%;
            margin: 5% 0 2% 0;
        }

        #cour-details.active .container-right .cdtls-block2 .cour-body .public-cible h3{
            font-size: 1.5em;
        }

        #cour-details.active .container-right .cdtls-block2 .cour-body .public-cible ul{
            display: flex;
            flex-direction: column;
            justify-content: space-around;

        }
        #cour-details.active .container-right .cdtls-block2 .cour-body .pre-requis{
            padding: 0 0 2% 5%;
            margin: 2% 0 2% 0;
        }

        #cour-details.active .container-right .cdtls-block2 .cour-body .pre-requis h3{
            font-size: 1.5em;
            padding: 2% 0 1% 0;
        }
        #cour-details.active .container-right .cdtls-block2 .cour-body .btn-buy-cour{
            border:none;
            width: 80%;
            color: black;
            font-size: 1.2em;
            display:flex;
            justify-content: center;
            align-items: center;
            font-weight: 500;
            height: 5vh;
            border-radius: 15px;
            background-color: orange;
            margin: 0 0 10% 10%;
        }

        #cour-details.active #sell-cour-detail-overlay{
            width: 0;
            height: 0;
            z-index: 12;
            overflow: hidden;
            background-color: var(--secondary);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        #cour-details.active #sell-cour-detail-overlay.active{
            width: 100%;
            height: 100%;
            transition: height .5s ease-out;
        }

        #cour-details.active #sell-cour-detail-overlay.active .sell-cour-steps{
            border: 1px solid white;
            position: relative;
            height: 100%;
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
         }

        #cour-details.active #sell-cour-detail-overlay.active .sell-cour-steps .step1{
            position: absolute;
            width: 40%;
            height: 50%;
            color: white;
            background-color: #434343ff;
            overflow: hidden;
            border-radius: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: space-around;
        }

        #cour-details.active #sell-cour-detail-overlay.active .sell-cour-steps .step1 .head{
            width: 90%;
            height: 30%;
            display: flex;
            border-radius : 10px;
            justify-content: space-around;
            align-items: center;
            background-color: var(--graylite);
        }

        #cour-details.active #sell-cour-detail-overlay.active .sell-cour-steps .step1 .head .block1{
            width: 25%;
            height: 90%;
        }

        #cour-details.active #sell-cour-detail-overlay.active .sell-cour-steps .step1 .head .block1 img{
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        #cour-details.active #sell-cour-detail-overlay.active .sell-cour-steps .step1 .head .block2{
            width: 70%;
        }

        #cour-details.active #sell-cour-detail-overlay.active .sell-cour-steps .step1 .head .block2 .cour-price{
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid gray;
            width: 90%;
            height: 50%;
            color: gray;
            font-size: 1.1em;
        }

        #cour-details.active #sell-cour-detail-overlay.active .sell-cour-steps .step1 .head .block2 .cour-price .price{
            color: white;
            font-size: 1.2em;
            font-weight: 600;
        }


        #cour-details.active #sell-cour-detail-overlay.active .sell-cour-steps .step1 .head .block2 .validite{
            display: flex;
            justify-content: space-between;
            width:90%;
            font-size: 1.2em;
            color: gray;

        }
        #cour-details.active #sell-cour-detail-overlay.active .sell-cour-steps .step1 .head .block2 .validite button{
            border: none;
            background: transparent;
            color: var(--green); 
        }

        #cour-details.active #sell-cour-detail-overlay.active .sell-cour-steps .step1 .payment-methods{
            display: fleX;
            flex-direction: column;
            justify-content: center;
            width: 90%;
            height: 30%;
            padding: 2% 0 0 0;
        }

        #cour-details.active #sell-cour-detail-overlay.active .sell-cour-steps .step1 .payment-methods .btns{
            width: 100%;
            height: 80%;
            margin: 2% 0 0 0;
            display: flex;
            justify-content: space-around;
            
        }

        #cour-details.active #sell-cour-detail-overlay.active .sell-cour-steps .step1 .payment-methods button{
            background-color: var(--green);
            width: 45%;
            height: 5vh;
            border-radius: 15px;
            display:flex;
            justify-content: center;
            align-items: center;
            border: none;
        }
        #cour-details.active #sell-cour-detail-overlay.active .sell-cour-steps .step1 .payment-methods .card-payment{}
        #cour-details.active #sell-cour-detail-overlay.active .sell-cour-steps .step1 .payment-methods .mobile-money{}
        #cour-details.active #sell-cour-detail-overlay.active .sell-cour-steps .step1 .poursuivre{
            width: 90%;
            background-color: orange;
            color: black;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 15px;
            height: 6vh;
            font-size: 1.2em;

        }

        #cour-details.active #sell-cour-detail-overlay.active .sell-cour-steps .step1 .payment-methods form{
            width: 90%;
            border: 1px solid white;
        }

        #cour-details.active #sell-cour-detail-overlay.active .sell-cour-steps .step1 .payment-methods form .ctn-card-name{}
        #cour-details.active #sell-cour-detail-overlay.active .sell-cour-steps .step1 .payment-methods form .ctn-card-number{}

        #cour-details.active #sell-cour-detail-overlay.active .sell-cour-steps .step1 .payment-methods form label{
            color: white;
        }

        #cour-details.active #sell-cour-detail-overlay.active .sell-cour-steps .step1 .payment-methods form input{
            width: 100%;
            border: none;
        }

        #cour-details.active #sell-cour-detail-overlay.active .sell-cour-steps .step1 .payment-methods form::placeholder{
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        #cour-details.active #sell-cour-detail-overlay.active .sell-cour-steps .step1 .payment-methods form input:focus{
            outline: none;
        }

        #card-payment{}

        #mobile-payement{}

    </style>

    <script>

        document.addEventListener('DOMContentLoaded', function(){
            const pauses = document.querySelectorAll('.pause');
            const listes = document.querySelectorAll('#categories ul li');
            const main = document.querySelector('main');
            const navList = document.querySelectorAll('nav ul li');
            const profilePage = document.querySelector('#profile');
            const profileLink = document.querySelector('nav ul li.profile-link');
            const pourToi = document.querySelector('nav ul li.pour-toi');
            const messagerie = document.querySelector('nav ul li.messagerie');
            const formaSuivie = document.querySelector('nav ul li.forma-suivie');
            const btnParam = document.querySelector('#profile .user .user-profile .btns .param');
            const btnShare = document.querySelector('#profile .user .user-profile .btns .profile-share');
            const btnChangeCover = document.querySelector('#profile .user .user-profile .btns .change-cover');
            const coverPic = document.querySelector('#cover-pic');
            const profilePic = document.querySelector('#profile-pic');
            const overlay = document.querySelector('#overlay');
            const params = document.querySelector('#params');
            const paramHead = document.querySelector('#params .param-head');
            const closeParam = document.querySelector('#params .param-head .par-head-block1 .btn-close-param');
            const infoPerso = document.querySelector('#params .btns .info-perso');
            const courDetailsPage = document.querySelector('#cour-details');
            const courDetailBtnBack = document.querySelector('#cour-details .container-left button');
            const allCours = document.querySelectorAll('#cours .items .cour');
            const coursLi = document.querySelectorAll('#cours ul li');
            const btnDelAcc = document.querySelector('#params .btns .btn-del-acc');
            const btnDevForma = document.querySelector('#params .btns .btn-dev-forma');
            const btnInfoPerso = document.querySelector('#params .btns .btn-info-perso');
            const switchAcc = document.querySelector('#switch-acc');
            const btnCtnSwitchAcc = document.querySelector('#switch-acc .switch-acc-btn-ctn');
            const delAccMsg = document.querySelector('#del-acc-msg');
            const btnConfirmDelAcc = document.querySelector('#del-acc-msg form .btn-del-acc-msg');
            const delReasons = document.querySelector('#params .body .del-reasons');
            const btnDelAccReturn = document.querySelector('.btn-del-acc-return');
            const btnCancelDel = document.querySelector('#params .del-reasons .foot .btn-del-cancel');
            const btnContinuDelAcc = document.querySelector('#params .del-reasons .foot .btn-continue-del-acc');
            const sellCourOverlay = document.querySelector('#cour-details #sell-cour-detail-overlay');
            const btnBuyCour = document.querySelector('#cour-details .cour-detail-body .btn-buy-cour');
            const btnCardPay = document.querySelector('#sell-cour-detail-overlay .sell-cour-steps .step1 .payment-methods .btns .card-payement');
            const btnMobilePay = document.querySelector('#sell-cour-detail-overlay .sell-cour-steps .payment-methods .btns .mobile-money');
            console.log(btnCardPay, btnMobilePay)

            // Buying a cour process

            btnBuyCour.addEventListener('click', (e)=>{
                sellCourOverlay.classList.add('active');
            });

            // Cour detail backward
            courDetailBtnBack.addEventListener('click', (e)=>{
                e.preventDefault();
                courDetailsPage.classList.remove('active');
            });
            // Appear the cour details

            allCours.forEach((cour) => {
                cour.addEventListener('click', (e)=>{
                    e.preventDefault();
                    console.log('clické')
                    courDetailsPage.classList.add('active');
                });
            });
               
            // Request to delete an account

            btnContinuDelAcc.addEventListener('click', (e)=>{
                console.log(delAccMsg);
                params.classList.remove('active');
                delReasons.classList.remove('active');
                overlay.classList.remove('active');
                overlay.classList.add('del-acc');
                delAccMsg.classList.add('active');
                
            });

            
            // Back on the parameters from delete account interface

            btnCancelDel.addEventListener('click', (e)=>{
                e.preventDefault();
                delReasons.classList.remove('active');
                paramHead.classList.remove('active');
            });
             
            btnDelAccReturn.addEventListener('click', (e)=>{
                e.preventDefault();
                delReasons.classList.remove('active');
                paramHead.classList.remove('active');

            });

            // Confirmation of the deletion of the account

                btnConfirmDelAcc.addEventListener('click', (e)=>{
                    e.preventDefault();
                    
                    $.ajax({
                        type: 'DELETE',
                        url: 'del-user',
                        success: function(response){

                        },

                        error: function(erreurs){

                        },

                    });
                });
                      
            // Initiate the account deletion process 
                btnDelAcc.addEventListener('click', (e)=>{
                    e.preventDefault();
                    if(!delReasons.classList.contains('active')){
                        
                        delReasons.classList.add('active');
                        paramHead.classList.add('active');

                    }else{
                        return
                    }

                });

            // Action executed when the user want to swicth the type of account

            btnDevForma.addEventListener('click', (e)=>{
                e.preventDefault();
                params.classList.remove('active');
                overlay.classList.remove('active');
                overlay.classList.add('del-acc');
                switchAcc.classList.add('active');
            });
            
            // Show the personnaly information in the parameters
            btnInfoPerso.addEventListener('click', (e)=>{
                e.preventDefault();
                if(infoPerso.classList.contains('active')){
                    infoPerso.classList.remove('active');
                }else{
                    infoPerso.classList.add('active');
                }
            })

            // Animation on les active cour element

            coursLi.forEach((courLi) =>{
                courLi.addEventListener('click', (e)=>{
                    e.preventDefault();
                    const active = document.querySelector('#cours ul li.active');
                    if(active) active.classList.remove('active');
                    if(e.currentTarget.classList.contains('active')) return;
                    e.currentTarget.classList.add('active');
                });
            });

            main.style.cssText += 'display:flex; width:100%; height:100%;';

            // Appear the params & close params

            btnParam.addEventListener('click', (e)=>{
                e.preventDefault();
                if(! overlay.classList.contains('active')) overlay.classList.add('active');
                if(! params.classList.contains('active')) params.classList.add('active');
            });

            closeParam.addEventListener('click', (e)=>{
                params.classList.remove('active');
                overlay.classList.remove('active');
            });

            // Change the profile and cover picture

            btnChangeCover.addEventListener('click', (e)=> {
                e.preventDefault();
                coverPic.click();
            });

            // btnChangeCover.addEventListener('click', (e)=> {
            //     e.preventDefault();
            //     coverPic.click();
            // });

            // Appear the home page

            pourToi.addEventListener('click', (e)=>{
                e.preventDefault();
                if(pourToi.classList.contains('active')) return;
                if(profileLink.classList.contains('active')) profileLink.classList.remove('active');
                if(profilePage.classList.contains('active')) profilePage.classList.remove('active');
                if(messagerie.classList.contains('active')) messagerie.classList.remove('active');
                if(formaSuivie.classList.contains('active')) formaSuivie.classList.remove('active');
                pourToi.classList.add('active');
            });

            // Make the profile page appear

            profileLink.addEventListener('click', (e)=>{
                e.preventDefault();
                if(profileLink.classList.contains('active')) return;
                profilePage.classList.add('active');
            })

            // Animate the nav element

            navList.forEach(li =>{
                li.addEventListener('click', (e)=>{
                    e.preventDefault();
                    const pageListActive = document.querySelector('nav ul li.active');
                    if(pageListActive?.classList.contains('active')) pageListActive?.classList.remove('active');
                    if(e.currentTarget.classList.contains('active')) return;
                    e.currentTarget.classList.add('active');
                                  
                });
            });

            listes.forEach(liste =>{
                liste.addEventListener('click', (e)=>{
                    e.preventDefault();
                    const liActive = document.querySelector('#categories ul li.active');
                    if(liActive?.classList.contains('active')) liActive?.classList.remove('active');
                    if(e.currentTarget.classList.contains('active')){
                        e.currentTarget.classList.remove('active');
                        return;
                    }
                    
                    e.currentTarget.classList.add('active');
                });
            });

            // Play the video on the pause button's click 
            pauses.forEach(pause =>{
                pause.addEventListener('click', (e)=>{
                    e.preventDefault();
                    const video = pause.previousElementSibling;
                    if(pause.classList.contains('active')) {
                        pause.classList.add('unactive');
                        video.play();
                    }else{
                        return; 
                    }
                });

            });

        });

    </script>

    <nav>
        <div class="nav-head">
            <img src="https://www.bintschool.com/wp-content/uploads/2023/04/BintSchooloff.png" alt="" class="logo">
        </div>
        <div class="pages">
            <ul>
                MENU
                <li class="pour-toi active">
                    <svg xmlns="http://www.w3.org/2000/svg"  class="bi bi-house" viewBox="0 0 16 16">
                        <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5z"/>
                    </svg>
                    Pour toi
                </li>

                <li class="profile-link">
                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-person-fill" viewBox="0 0 16 16">
                        <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
                    </svg>
                    Profil
                </li>

                <li class="messagerie">
                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-chat-left-dots" viewBox="0 0 16 16">
                        <path d="M14 1a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H4.414A2 2 0 0 0 3 11.586l-2 2V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12.793a.5.5 0 0 0 .854.353l2.853-2.853A1 1 0 0 1 4.414 12H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z"/>
                        <path d="M5 6a1 1 0 1 1-2 0 1 1 0 0 1 2 0m4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0m4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0"/>
                    </svg>
                    Messagerie</li>
                <li class="forma-suivie">
                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-book-fill" viewBox="0 0 16 16">
                        <path d="M8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783"/>
                    </svg>    
                    Formation suivies
                </li>

            </ul> 
        </div>
        

        <button id="logout">
            <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-box-arrow-in-right" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0z"/>
                <path fill-rule="evenodd" d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z"/>
            </svg>    
        Déconnexion</button>
    </nav>

    <div id="blockpage">
            <section id="home">
                <div id="categories">
                    <ul>CATEGORIES
                        <li class="active">Toutes les catégories</li>
                        <li>cat1</li>
                        <li>cat2</li>
                        <li>cat3</li>
                        <li>cat4</li>
                        <li>cat5</li>
                        <li>cat6</li>
                        <li>cat7</li>
                        <li>cat8</li>
                        <li>cat9</li>
                        <li>cat10</li>
                        <li>cat11</li>
                        <li>cat12</li>
                        <li>cat13</li>
                        <li>cat14</li>
                        <li>cat15</li>
                        <li>cat16</li>
                        <li>cat17</li>
                        <li>cat18</li>
                        <li>cat19</li>
                        <li>cat20</li>
                    </ul>
                </div>

                <div id="content">

                    <div class="content-item">
                        <video  muted poster="{{ asset('images/image2.png') }}" preload="auto">
                            <source src="#" type=""> </source>
                        </video>
                        <div class="pause">
                            <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-play-fill" viewBox="0 0 16 16">
                                <path d="m11.596 8.697-6.363 3.692c-.54.313-1.233-.066-1.233-.697V4.308c0-.63.692-1.01 1.233-.696l6.363 3.692a.802.802 0 0 1 0 1.393"/>
                            </svg>
                        </div>
                        <div class="text">

                            <div class="user">
                                <img src=" {{ asset('images/image4.png') }}" alt="">
                                <div class="info">
                                    <h6>Username</h6>
                                    <div class="date">Date</div>
                                </div>
                                
                                <button class="btn-follow"> + suivre</button>
                            </div>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente nobis, dolore distinctio quisquam aspernatur perspiciatis ducimus repellat aliquam numquam vero ut atque nisi eum, laborum libero reiciendis nam quas nulla!</p>
                            <div class="btns">
                                <button>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-heart" viewBox="0 0 16 16">
                                        <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15"/>
                                    </svg>
                                </button>

                                <button>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-chat" viewBox="0 0 16 16">
                                        <path d="M2.678 11.894a1 1 0 0 1 .287.801 11 11 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8 8 0 0 0 8 14c3.996 0 7-2.807 7-6s-3.004-6-7-6-7 2.808-7 6c0 1.468.617 2.83 1.678 3.894m-.493 3.905a22 22 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a10 10 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9 9 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105"/>
                                    </svg>
                                </button>
                                <button>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-send" viewBox="0 0 16 16">
                                        <path d="M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576zm6.787-8.201L1.591 6.602l4.339 2.76z"/>
                                    </svg>
                                </button>
                            </div>
                            <div class="more">
                                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Fuga iste eum, similique impedit doloremque repudiandae sequi quisquam quidem voluptates placeat sunt adipisci commodi iure magni eligendi omnis. Neque, sequi vel.</p>
                                <button>savoir</button>
                            </div>
                        </div>
                    </div>

                    <div class="content-item">
                        <video src="" width="80%" height="90%"  muted poster=" {{ asset('images/image1.png') }}" preload="auto"></video>
                        <div class="pause">
                            <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-play-fill" viewBox="0 0 16 16">
                                <path d="m11.596 8.697-6.363 3.692c-.54.313-1.233-.066-1.233-.697V4.308c0-.63.692-1.01 1.233-.696l6.363 3.692a.802.802 0 0 1 0 1.393"/>
                            </svg>
                        </div>
                        <div class="text">

                            <div class="user">
                                <img src=" {{ asset('images/image4.png') }}" alt="">
                                <div class="info">
                                    <h6>Username</h6>
                                    <div class="date">Date</div>
                                </div>
                                
                                <button class="btn-follow"> + suivre</button>
                            </div>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente nobis, dolore distinctio quisquam aspernatur perspiciatis ducimus repellat aliquam numquam vero ut atque nisi eum, laborum libero reiciendis nam quas nulla!</p>
                            <div class="btns">
                                <button>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-heart" viewBox="0 0 16 16">
                                        <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15"/>
                                    </svg>
                                </button>

                                <button>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-chat" viewBox="0 0 16 16">
                                        <path d="M2.678 11.894a1 1 0 0 1 .287.801 11 11 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8 8 0 0 0 8 14c3.996 0 7-2.807 7-6s-3.004-6-7-6-7 2.808-7 6c0 1.468.617 2.83 1.678 3.894m-.493 3.905a22 22 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a10 10 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9 9 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105"/>
                                    </svg>
                                </button>
                                <button>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-send" viewBox="0 0 16 16">
                                        <path d="M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576zm6.787-8.201L1.591 6.602l4.339 2.76z"/>
                                    </svg>
                                </button>
                            </div>
                            <div class="more">
                                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Fuga iste eum, similique impedit doloremque repudiandae sequi quisquam quidem voluptates placeat sunt adipisci commodi iure magni eligendi omnis. Neque, sequi vel.</p>
                                <button>Savoir +</button>
                            </div>
                        </div>
                    </div>

                    <div class="content-item">
                        <video src="" width="80%" height="90%"  muted poster="{{ asset('images/image3.png') }}" preload="auto"></video>
                        <div class="pause">
                            <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-play-fill" viewBox="0 0 16 16">
                                <path d="m11.596 8.697-6.363 3.692c-.54.313-1.233-.066-1.233-.697V4.308c0-.63.692-1.01 1.233-.696l6.363 3.692a.802.802 0 0 1 0 1.393"/>
                            </svg>
                        </div>
                        <div class="text">

                            <div class="user">
                                <img src=" {{ asset('images/image4.png') }}" alt="">
                                <div class="info">
                                    <h6>Username</h6>
                                    <div class="date">Date</div>
                                </div>
                                
                                <button class="btn-follow"> + suivre</button>
                            </div>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente nobis, dolore distinctio quisquam aspernatur perspiciatis ducimus repellat aliquam numquam vero ut atque nisi eum, laborum libero reiciendis nam quas nulla!</p>
                            <div class="btns">
                                <button>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-heart" viewBox="0 0 16 16">
                                        <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15"/>
                                    </svg>
                                </button>

                                <button>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-chat" viewBox="0 0 16 16">
                                        <path d="M2.678 11.894a1 1 0 0 1 .287.801 11 11 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8 8 0 0 0 8 14c3.996 0 7-2.807 7-6s-3.004-6-7-6-7 2.808-7 6c0 1.468.617 2.83 1.678 3.894m-.493 3.905a22 22 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a10 10 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9 9 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105"/>
                                    </svg>
                                </button>
                                <button>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-send" viewBox="0 0 16 16">
                                        <path d="M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576zm6.787-8.201L1.591 6.602l4.339 2.76z"/>
                                    </svg>
                                </button>
                            </div>
                            <div class="more">
                                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Fuga iste eum, similique impedit doloremque repudiandae sequi quisquam quidem voluptates placeat sunt adipisci commodi iure magni eligendi omnis. Neque, sequi vel.</p>
                                <button>Savoir +</button>
                            </div>
                        </div>
                    </div>

                    <div class="content-item">
                        <video src="" width="80%" height="90%"  muted poster="{{ asset('images/image4.png') }}" preload="auto">

                        </video>
                        <div class="pause">
                            <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-play-fill" viewBox="0 0 16 16">
                                <path d="m11.596 8.697-6.363 3.692c-.54.313-1.233-.066-1.233-.697V4.308c0-.63.692-1.01 1.233-.696l6.363 3.692a.802.802 0 0 1 0 1.393"/>
                            </svg>
                        </div>
                        <div class="text">

                            <div class="user">
                                <img src=" {{ asset('images/image4.png') }}" alt="">
                                <div class="info">
                                    <h6>Username</h6>
                                    <div class="date">Date</div>
                                </div>
                                
                                <button class="btn-follow"> + suivre</button>
                            </div>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente nobis, dolore distinctio quisquam aspernatur perspiciatis ducimus repellat aliquam numquam vero ut atque nisi eum, laborum libero reiciendis nam quas nulla!</p>
                            <div class="btns">
                                <button>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-heart" viewBox="0 0 16 16">
                                        <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15"/>
                                    </svg>
                                </button>

                                <button>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-chat" viewBox="0 0 16 16">
                                        <path d="M2.678 11.894a1 1 0 0 1 .287.801 11 11 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8 8 0 0 0 8 14c3.996 0 7-2.807 7-6s-3.004-6-7-6-7 2.808-7 6c0 1.468.617 2.83 1.678 3.894m-.493 3.905a22 22 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a10 10 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9 9 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105"/>
                                    </svg>
                                </button>
                                <button>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-send" viewBox="0 0 16 16">
                                        <path d="M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576zm6.787-8.201L1.591 6.602l4.339 2.76z"/>
                                    </svg>
                                </button>
                            </div>
                            <div class="more">
                                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Fuga iste eum, similique impedit doloremque repudiandae sequi quisquam quidem voluptates placeat sunt adipisci commodi iure magni eligendi omnis. Neque, sequi vel.</p>
                                <button>Savoir +</button>
                            </div>
                        </div>
                    </div>


                </div>

                <aside>
                    <div class="search">
                        <div class="input-container">
                            <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-search" viewBox="0 0 16 16">
                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                            </svg>
                            <input type="text" placeholder="Rechercher">
                        </div>
                        <button class="btn-search">Rechercher</button>
                    </div>

                    <div id="suggestions">
                        <div class="video">
                            <video src="#" muted poster="" preload="auto"></video>
                            <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-play-fill" viewBox="0 0 16 16">
                                <path d="m11.596 8.697-6.363 3.692c-.54.313-1.233-.066-1.233-.697V4.308c0-.63.692-1.01 1.233-.696l6.363 3.692a.802.802 0 0 1 0 1.393"/>
                            </svg>
                        </div>

                        <div class="video">
                            <video src="#" muted poster="" preload="auto"></video>
                            <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-play-fill" viewBox="0 0 16 16">
                                <path d="m11.596 8.697-6.363 3.692c-.54.313-1.233-.066-1.233-.697V4.308c0-.63.692-1.01 1.233-.696l6.363 3.692a.802.802 0 0 1 0 1.393"/>
                            </svg>
                        </div>

                        <div class="video">
                            <video src="#" muted poster="" preload="auto"></video>
                            <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-play-fill" viewBox="0 0 16 16">
                                <path d="m11.596 8.697-6.363 3.692c-.54.313-1.233-.066-1.233-.697V4.308c0-.63.692-1.01 1.233-.696l6.363 3.692a.802.802 0 0 1 0 1.393"/>
                            </svg>
                        </div>

                        <div class="video">
                            <video src="#" muted poster="" preload="auto"></video>
                            <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-play-fill" viewBox="0 0 16 16">
                                <path d="m11.596 8.697-6.363 3.692c-.54.313-1.233-.066-1.233-.697V4.308c0-.63.692-1.01 1.233-.696l6.363 3.692a.802.802 0 0 1 0 1.393"/>
                            </svg>
                        </div>

                        <div class="video">
                            <video src="#" muted poster="" preload="auto"></video>
                            <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-play-fill" viewBox="0 0 16 16">
                                <path d="m11.596 8.697-6.363 3.692c-.54.313-1.233-.066-1.233-.697V4.308c0-.63.692-1.01 1.233-.696l6.363 3.692a.802.802 0 0 1 0 1.393"/>
                            </svg>
                        </div>

                        <div class="video">
                            <video src="#" muted poster="" preload="auto"></video>
                            <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-play-fill" viewBox="0 0 16 16">
                                <path d="m11.596 8.697-6.363 3.692c-.54.313-1.233-.066-1.233-.697V4.308c0-.63.692-1.01 1.233-.696l6.363 3.692a.802.802 0 0 1 0 1.393"/>
                            </svg>
                        </div>

                        <div class="video">
                            <video src="#" muted poster="" preload="auto"></video>
                            <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-play-fill" viewBox="0 0 16 16">
                                <path d="m11.596 8.697-6.363 3.692c-.54.313-1.233-.066-1.233-.697V4.308c0-.63.692-1.01 1.233-.696l6.363 3.692a.802.802 0 0 1 0 1.393"/>
                            </svg>
                        </div>

                        <div class="video">
                            <video src="#" muted poster="" preload="auto"></video>
                            <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-play-fill" viewBox="0 0 16 16">
                                <path d="m11.596 8.697-6.363 3.692c-.54.313-1.233-.066-1.233-.697V4.308c0-.63.692-1.01 1.233-.696l6.363 3.692a.802.802 0 0 1 0 1.393"/>
                            </svg>
                        </div>
                        
                        <!-- <video src="#" muted poster="" preload="auto"></video>
                        <video src="#" muted poster="" preload="auto"></video>
                        <video src="#" muted poster="" preload="auto"></video>
                        <video src="#" muted poster="" preload="auto"></video>
                        <video src="#" muted poster="" preload="auto"></video> -->
                    </div>

                </aside>

            </section>


            
            <!-- Represent the profil page -->


            <section id="profile">

                <!-- Contain user information -->
                <div class="user">
                    <div class="cover">
                        <img src="https://images.pexels.com/photos/956999/milky-way-starry-sky-night-sky-star-956999.jpeg" alt="">
                    </div>

                    <div class="user-profile">
                        <div class="user-info">
                            <img src=" {{ asset('images/image4.png') }}" alt="">
                            <h2>Username</h2>
                            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Exercitationem, officia earum nihil, modi beatae consequuntur ea voluptatibus asperiores, enim magnam harum dolorum nobis doloremque deserunt sunt aliquid quisquam nulla. Nisi!</p>
                            <div class="followers">
                                <div><span>Followers: </span> 100 | </div> <div><span>Suivi: </span> 100  | </div> <div> <span class="profession">Developpeur</span></div>
                            </div>
                        </div>

                            <!-- Contain the buttons in the profil -->
                        <div class="btns">
                            <button class="change-cover">changer cover</button>
                            <button class="profile-share">Partage profil</button>
                            <button class="param">Paramètres</button>
                        </div>
                    </div>

                </div>

                <!-- This part represent the profil completion elements -->

                <div class="complete-profil">

                    <div class="block1">
                        <div class="percentage"> <!-- contain percentage --> </div>

                        <div class="checkboxs">
                            <h2>Complèter votre profil</h2>
                            <div class="checks">
                                <div class="check-item"> <div class="check">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-check-circle" viewBox="0 0 16 16">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                        <path d="m10.97 4.97-.02.022-3.473 4.425-2.093-2.094a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05"/>
                                    </svg>
                                </div> Ajouter une photo de profil </div>
                                <div class="check-item"> <div class="check">
                                    <svg xmlns="http://www.w3.org/2000/svg"  class="bi bi-check-circle" viewBox="0 0 16 16">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                        <path d="m10.97 4.97-.02.022-3.473 4.425-2.093-2.094a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05"/>
                                    </svg>
                                </div> Confirmer l'adresse mail</div>
                                <div class="check-item"> <div class="check">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-check-circle" viewBox="0 0 16 16">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                        <path d="m10.97 4.97-.02.022-3.473 4.425-2.093-2.094a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05"/>
                                    </svg>
                                </div> Acheter un cour </div>
                            </div>
                        </div>

                        <div class="congratulations"> 
                            <h4><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960"><path d="m80-80 200-560 360 360L80-80Zm132-132 282-100-182-182-100 282Zm370-246-42-42 224-224q32-32 77-32t77 32l24 24-42 42-24-24q-14-14-35-14t-35 14L582-458ZM422-618l-42-42 24-24q14-14 14-34t-14-34l-26-26 42-42 26 26q32 32 32 76t-32 76l-24 24Zm80 80-42-42 144-144q14-14 14-35t-14-35l-64-64 42-42 64 64q32 32 32 77t-32 77L502-538Zm160 160-42-42 64-64q32-32 77-32t77 32l64 64-42 42-64-64q-14-14-35-14t-35 14l-64 64ZM212-212Z"/></svg>Bravo, vous y êtes presque.</h4>
                            <p>Continuer de compléter les étapes pour avoir un profil parfait</p>
                        </div>
                    </div>

                    <!-- This contain the second block of the complete profil block (Mail confirmation link) -->

                    <div class="block2">
                        <div class="block2-item">
                            <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-mailbox2" viewBox="0 0 16 16">
                                <path d="M9 8.5h2.793l.853.854A.5.5 0 0 0 13 9.5h1a.5.5 0 0 0 .5-.5V8a.5.5 0 0 0-.5-.5H9z"/>
                                <path d="M12 3H4a4 4 0 0 0-4 4v6a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1V7a4 4 0 0 0-4-4M8 7a4 4 0 0 0-1.354-3H12a3 3 0 0 1 3 3v6H8zm-3.415.157C4.42 7.087 4.218 7 4 7s-.42.086-.585.157C3.164 7.264 3 7.334 3 7a1 1 0 0 1 2 0c0 .334-.164.264-.415.157"/>
                            </svg>

                            <div class="send-link">
                                <h4>Un lien de confirmation a été envoyé</h4>
                                <div class="link-mail"><p>Votre addresse mail: iba@gmail.com</p> <a href="">Modifier</a></div>
                            </div>
                        </div>

                        <button>Renvoyez le lien</button>
                    </div>

                </div>
                <!-- Cours template -->
                <div id="cours">
                    <ul>
                        <li class="active">Favoris</li>
                        <li>Cours suivis</li>
                        <li>Derniers cours suivis</li>
                    </ul>

                    <!-- template of a single cour -->

                    <div class="items">

                        <div class="cour">
                            <img src="{{ asset('images/image2.png') }}" alt="img-cour">
                            <div class="text">
                                <h4>nom cour</h4>
                                <div class="meta-info">
                                    <div class="hour">hour</div>
                                    <div class="cour-cate">cour-cate</div>
                                    <div class="publisher"> <img src="" alt=""> publisher</div>
                                </div>
                            </div>
                        </div>

                        <div class="cour">
                            <img src="{{ asset('images/image2.png') }}" alt="img-cour">
                            <div class="text">
                                <h4>nom cour</h4>
                                <div class="meta-info">
                                    <div class="hour">hour</div>
                                    <div class="cour-cate">cour-cate</div>
                                    <div class="publisher"> <img src="" alt=""> publisher</div>
                                </div>
                            </div>
                        </div>

                        <div class="cour">
                            <img src="{{ asset('images/image2.png') }}" alt="img-cour">
                            <div class="text">
                                <h4>nom cour</h4>
                                <div class="meta-info">
                                    <div class="hour">hour</div>
                                    <div class="cour-cate">cour-cate</div>
                                    <div class="publisher"> <img src="" alt=""> publisher</div>
                                </div>
                            </div>
                        </div>

                        <div class="cour">
                            <img src="{{ asset('images/image2.png') }}" alt="img-cour">
                            <div class="text">
                                <h4>nom cour</h4>
                                <div class="meta-info">
                                    <div class="hour">hour</div>
                                    <div class="cour-cate">cour-cate</div>
                                    <div class="publisher"> <img src="" alt=""> publisher</div>
                                </div>
                            </div>
                        </div>

                    </div>

                    
                </div>

                <div id="inputs">
                    <input type="file" id="profile-pic" name="profile-pic">
                    <input type="file" id="cover-pic" name="cover-pic">
                </div>

            </section>

            <!-- The cour-detail page -->

            <section id="cour-details">
                <div class="cour-detail-body">
                    <div class="container-left">
                        <button>
                            <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-chevron-left" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0"/>
                            </svg>
                            Retour
                        </button>
                    </div>

                    <div class="container-right">
                        <div class="cdtls-block1">
                            <img src=" {{ asset('images/image2.png') }} " alt="">
                        </div>

                        <div class="cdtls-block2">
                            <!-- The cour introduction (Head) -->
                            <div class="cour-intro">
                                <div class="cour-cat"> Categorie : Business</div>
                                <h3>Créer un compte paypal professionnel depuis l'Afrique(Pays non éligibles) </h3>
                                <div class="stars">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-star-fill" viewBox="0 0 16 16">
                                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-star-fill" viewBox="0 0 16 16">
                                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-star-fill" viewBox="0 0 16 16">
                                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                    </svg>
                                
                                </div>
                                <div class="cour-reactions">

                                    <button>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-heart" viewBox="0 0 16 16">
                                            <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15"/>
                                        </svg>
                                    </button>

                                    <button>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-chat" viewBox="0 0 16 16">
                                            <path d="M2.678 11.894a1 1 0 0 1 .287.801 11 11 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8 8 0 0 0 8 14c3.996 0 7-2.807 7-6s-3.004-6-7-6-7 2.808-7 6c0 1.468.617 2.83 1.678 3.894m-.493 3.905a22 22 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a10 10 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9 9 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105"/>
                                        </svg>
                                    </button>

                                    <button>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-send" viewBox="0 0 16 16">
                                            <path d="M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576zm6.787-8.201L1.591 6.602l4.339 2.76z"/>
                                        </svg>
                                    </button>
                                </div>

                                <div class="cour-formateur">
                                    <div class="formateur-info">
                                        <img src="{{ asset('images/image4.png') }} " alt="">
                                        <div class="formateur">
                                            <h4>Jean Marc Krebe</h4>
                                            <span>Spécialist Marketing Digital</span>
                                        </div>
                                        <button class="visiter">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                                <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/>
                                                <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7"/>
                                            </svg>
                                            Visiter
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <!-- The cour body -->
                            <div class="cour-body">

                                <div class="a-propos">
                                    <h3>A propos de ce cour</h3>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolores tempora animi sit illo! Repellat id, quaerat inventore totam fuga doloremque sed veniam explicabo accusamus mollitia sit rerum dolore ex fugit.</p>
                                    <button class="acces">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-heart-fill" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314"/>
                                        </svg>
                                        Acces gratuit
                                    </button>

                                    <div class="btns">
                                        <button>
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960">
                                                <path d="m826-585-56-56 30-31-128-128-31 30-57-57 30-31q23-23 57-22.5t57 23.5l129 129q23 23 23 56.5T857-615l-31 30ZM346-104q-23 23-56.5 23T233-104L104-233q-23-23-23-56.5t23-56.5l30-30 57 57-31 30 129 129 30-31 57 57-30 30Zm397-336 57-57-303-303-57 57 303 303ZM463-160l57-58-302-302-58 57 303 303Zm-6-234 110-109-64-64-109 110 63 63Zm63 290q-23 23-57 23t-57-23L104-406q-23-23-23-57t23-57l57-57q23-23 56.5-23t56.5 23l63 63 110-110-63-62q-23-23-23-57t23-57l57-57q23-23 56.5-23t56.5 23l303 303q23 23 23 56.5T857-441l-57 57q-23 23-57 23t-57-23l-62-63-110 110 63 63q23 23 23 56.5T577-161l-57 57Z"/>
                                            </svg>
                                            Tous les niveaux
                                        </button>
                                        <button>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-people" viewBox="0 0 16 16">
                                                <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1zm-7.978-1L7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002-.014.002zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0M6.936 9.28a6 6 0 0 0-1.23-.247A7 7 0 0 0 5 9c-4 0-5 3-5 4q0 1 1 1h4.216A2.24 2.24 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816M4.92 10A5.5 5.5 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275ZM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0m3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4"/>
                                            </svg>
                                            420 Incrits
                                        </button>
                                        <button>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-clock" viewBox="0 0 16 16">
                                                <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z"/>
                                                <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0"/>
                                            </svg>
                                            4H
                                        </button>
                                    </div>
                                </div>
                                <!-- Chapitre du cour -->
                                <div class="cour-chapters">
                                    <h3>Qu'Allez-vous apprendre</h3>
                                    <div class="chapters-items">
                                        <div class="item">
                                            <button>
                                                <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-1-square" viewBox="0 0 16 16">
                                                    <path d="M9.283 4.002V12H7.971V5.338h-.065L6.072 6.656V5.385l1.899-1.383z"/>
                                                    <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm15 0a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1z"/>
                                                </svg>
                                            </button>
                                            Contourner les restrictions paypal
                                        </div>
                                        <div class="item">
                                            <button>
                                                <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-2-square" viewBox="0 0 16 16">
                                                    <path d="M6.646 6.24v.07H5.375v-.064c0-1.213.879-2.402 2.637-2.402 1.582 0 2.613.949 2.613 2.215 0 1.002-.6 1.667-1.287 2.43l-.096.107-1.974 2.22v.077h3.498V12H5.422v-.832l2.97-3.293c.434-.475.903-1.008.903-1.705 0-.744-.557-1.236-1.313-1.236-.843 0-1.336.615-1.336 1.306"/>
                                                    <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm15 0a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1z"/>
                                                </svg>
                                            </button>
                                            Contourner les restrictions paypal
                                        </div>
                                        <div class="item">
                                            <button>
                                                <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-3-square" viewBox="0 0 16 16">
                                                    <path d="M7.918 8.414h-.879V7.342h.838c.78 0 1.348-.522 1.342-1.237 0-.709-.563-1.195-1.348-1.195-.79 0-1.312.498-1.348 1.055H5.275c.036-1.137.95-2.115 2.625-2.121 1.594-.012 2.608.885 2.637 2.062.023 1.137-.885 1.776-1.482 1.875v.07c.703.07 1.71.64 1.734 1.917.024 1.459-1.277 2.396-2.93 2.396-1.705 0-2.707-.967-2.754-2.144H6.33c.059.597.68 1.06 1.541 1.066.973.006 1.6-.563 1.588-1.354-.006-.779-.621-1.318-1.541-1.318"/>
                                                    <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm15 0a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1z"/>
                                                </svg>
                                            </button>
                                            Contourner les restrictions paypal
                                        </div>
                                    </div>
                                </div>
                                <!-- Modules du cours -->
                                <div class="cour-content">
                                    <h3>Contenu du cour</h3>
                                    <div class="part">Partie 1</div>

                                    <div class="content-items">
                                        <div class="item">
                                            <div>
                                                <button>
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-play-fill" viewBox="0 0 16 16">
                                                        <path d="m11.596 8.697-6.363 3.692c-.54.313-1.233-.066-1.233-.697V4.308c0-.63.692-1.01 1.233-.696l6.363 3.692a.802.802 0 0 1 0 1.393"/>
                                                    </svg>
                                                </button> Titre du module
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-lock" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M8 0a4 4 0 0 1 4 4v2.05a2.5 2.5 0 0 1 2 2.45v5a2.5 2.5 0 0 1-2.5 2.5h-7A2.5 2.5 0 0 1 2 13.5v-5a2.5 2.5 0 0 1 2-2.45V4a4 4 0 0 1 4-4M4.5 7A1.5 1.5 0 0 0 3 8.5v5A1.5 1.5 0 0 0 4.5 15h7a1.5 1.5 0 0 0 1.5-1.5v-5A1.5 1.5 0 0 0 11.5 7zM8 1a3 3 0 0 0-3 3v2h6V4a3 3 0 0 0-3-3"/>
                                                </svg>
                                            </div>
                                            
                                        </div>
                                        <div class="item">
                                            <div>
                                                <button>
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-play-fill" viewBox="0 0 16 16">
                                                        <path d="m11.596 8.697-6.363 3.692c-.54.313-1.233-.066-1.233-.697V4.308c0-.63.692-1.01 1.233-.696l6.363 3.692a.802.802 0 0 1 0 1.393"/>
                                                    </svg>
                                                </button> Titre du module
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-lock" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M8 0a4 4 0 0 1 4 4v2.05a2.5 2.5 0 0 1 2 2.45v5a2.5 2.5 0 0 1-2.5 2.5h-7A2.5 2.5 0 0 1 2 13.5v-5a2.5 2.5 0 0 1 2-2.45V4a4 4 0 0 1 4-4M4.5 7A1.5 1.5 0 0 0 3 8.5v5A1.5 1.5 0 0 0 4.5 15h7a1.5 1.5 0 0 0 1.5-1.5v-5A1.5 1.5 0 0 0 11.5 7zM8 1a3 3 0 0 0-3 3v2h6V4a3 3 0 0 0-3-3"/>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="item">
                                            <div>
                                                <button>
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-play-fill" viewBox="0 0 16 16">
                                                        <path d="m11.596 8.697-6.363 3.692c-.54.313-1.233-.066-1.233-.697V4.308c0-.63.692-1.01 1.233-.696l6.363 3.692a.802.802 0 0 1 0 1.393"/>
                                                    </svg>
                                                </button> Titre du module
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-lock" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M8 0a4 4 0 0 1 4 4v2.05a2.5 2.5 0 0 1 2 2.45v5a2.5 2.5 0 0 1-2.5 2.5h-7A2.5 2.5 0 0 1 2 13.5v-5a2.5 2.5 0 0 1 2-2.45V4a4 4 0 0 1 4-4M4.5 7A1.5 1.5 0 0 0 3 8.5v5A1.5 1.5 0 0 0 4.5 15h7a1.5 1.5 0 0 0 1.5-1.5v-5A1.5 1.5 0 0 0 11.5 7zM8 1a3 3 0 0 0-3 3v2h6V4a3 3 0 0 0-3-3"/>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="item">
                                            <div>
                                                <button>
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-play-fill" viewBox="0 0 16 16">
                                                        <path d="m11.596 8.697-6.363 3.692c-.54.313-1.233-.066-1.233-.697V4.308c0-.63.692-1.01 1.233-.696l6.363 3.692a.802.802 0 0 1 0 1.393"/>
                                                    </svg>
                                                </button> Titre du module
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-lock" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M8 0a4 4 0 0 1 4 4v2.05a2.5 2.5 0 0 1 2 2.45v5a2.5 2.5 0 0 1-2.5 2.5h-7A2.5 2.5 0 0 1 2 13.5v-5a2.5 2.5 0 0 1 2-2.45V4a4 4 0 0 1 4-4M4.5 7A1.5 1.5 0 0 0 3 8.5v5A1.5 1.5 0 0 0 4.5 15h7a1.5 1.5 0 0 0 1.5-1.5v-5A1.5 1.5 0 0 0 11.5 7zM8 1a3 3 0 0 0-3 3v2h6V4a3 3 0 0 0-3-3"/>
                                                </svg>
                                            </div>
                                        </div>

                                        <div class="part">Partie 2</div>

                                        <div class="item">
                                            <div>
                                                <button>
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-play-fill" viewBox="0 0 16 16">
                                                        <path d="m11.596 8.697-6.363 3.692c-.54.313-1.233-.066-1.233-.697V4.308c0-.63.692-1.01 1.233-.696l6.363 3.692a.802.802 0 0 1 0 1.393"/>
                                                    </svg>
                                                </button> Titre du module
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-lock" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M8 0a4 4 0 0 1 4 4v2.05a2.5 2.5 0 0 1 2 2.45v5a2.5 2.5 0 0 1-2.5 2.5h-7A2.5 2.5 0 0 1 2 13.5v-5a2.5 2.5 0 0 1 2-2.45V4a4 4 0 0 1 4-4M4.5 7A1.5 1.5 0 0 0 3 8.5v5A1.5 1.5 0 0 0 4.5 15h7a1.5 1.5 0 0 0 1.5-1.5v-5A1.5 1.5 0 0 0 11.5 7zM8 1a3 3 0 0 0-3 3v2h6V4a3 3 0 0 0-3-3"/>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="item">
                                            <div>
                                                <button>
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-play-fill" viewBox="0 0 16 16">
                                                        <path d="m11.596 8.697-6.363 3.692c-.54.313-1.233-.066-1.233-.697V4.308c0-.63.692-1.01 1.233-.696l6.363 3.692a.802.802 0 0 1 0 1.393"/>
                                                    </svg>
                                                </button> Titre du module
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-lock" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M8 0a4 4 0 0 1 4 4v2.05a2.5 2.5 0 0 1 2 2.45v5a2.5 2.5 0 0 1-2.5 2.5h-7A2.5 2.5 0 0 1 2 13.5v-5a2.5 2.5 0 0 1 2-2.45V4a4 4 0 0 1 4-4M4.5 7A1.5 1.5 0 0 0 3 8.5v5A1.5 1.5 0 0 0 4.5 15h7a1.5 1.5 0 0 0 1.5-1.5v-5A1.5 1.5 0 0 0 11.5 7zM8 1a3 3 0 0 0-3 3v2h6V4a3 3 0 0 0-3-3"/>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="item">
                                            <div>
                                                <button>
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-play-fill" viewBox="0 0 16 16">
                                                        <path d="m11.596 8.697-6.363 3.692c-.54.313-1.233-.066-1.233-.697V4.308c0-.63.692-1.01 1.233-.696l6.363 3.692a.802.802 0 0 1 0 1.393"/>
                                                    </svg>
                                                </button> Titre du module
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-lock" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M8 0a4 4 0 0 1 4 4v2.05a2.5 2.5 0 0 1 2 2.45v5a2.5 2.5 0 0 1-2.5 2.5h-7A2.5 2.5 0 0 1 2 13.5v-5a2.5 2.5 0 0 1 2-2.45V4a4 4 0 0 1 4-4M4.5 7A1.5 1.5 0 0 0 3 8.5v5A1.5 1.5 0 0 0 4.5 15h7a1.5 1.5 0 0 0 1.5-1.5v-5A1.5 1.5 0 0 0 11.5 7zM8 1a3 3 0 0 0-3 3v2h6V4a3 3 0 0 0-3-3"/>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="item">
                                            <div>
                                                <button>
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-play-fill" viewBox="0 0 16 16">
                                                        <path d="m11.596 8.697-6.363 3.692c-.54.313-1.233-.066-1.233-.697V4.308c0-.63.692-1.01 1.233-.696l6.363 3.692a.802.802 0 0 1 0 1.393"/>
                                                    </svg>
                                                </button> Titre du module
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-lock" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M8 0a4 4 0 0 1 4 4v2.05a2.5 2.5 0 0 1 2 2.45v5a2.5 2.5 0 0 1-2.5 2.5h-7A2.5 2.5 0 0 1 2 13.5v-5a2.5 2.5 0 0 1 2-2.45V4a4 4 0 0 1 4-4M4.5 7A1.5 1.5 0 0 0 3 8.5v5A1.5 1.5 0 0 0 4.5 15h7a1.5 1.5 0 0 0 1.5-1.5v-5A1.5 1.5 0 0 0 11.5 7zM8 1a3 3 0 0 0-3 3v2h6V4a3 3 0 0 0-3-3"/>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Public cible -->
                                <div class="public-cible">
                                    <h3>Public cible</h3>
                                    <ul>
                                        <li>Freelanceur et entrepreneurs</li>
                                        <li>Paiement internations</li>
                                    </ul>
                                </div>
                                <!-- Pre requis -->
                                <div class="pre-requis">
                                    <h3>Prérequis</h3>
                                    <ul>
                                        <li>Téléphone et oridination connecté à internet</li>
                                    </ul>
                                </div>
                                <button class="btn-buy-cour">Obtenir ce cours</button>
                            </div>

                        </div>
                    </div>
                </div>

                <div id="sell-cour-detail-overlay">

                    <div class="sell-cour-steps">

                        <div class="step1">
                            <div class="head">
                                <div class="block1">
                                    <img src=" {{ asset('images/image2.png') }}" alt="">
                                </div>
                                
                                <div class="block2">
                                    <h3 class="cour-name">Nom du cour</h3>
                                    <div class="cour-price">
                                        Montant à payer: <div class="price"> 400 000 cfa</div>
                                    </div>
                                    <div class="validite">
                                        <div>Validité : </div>
                                        <button>Accès à vie</button>
                                    </div>
                                </div>

                            </div>

                            <div class="payment-methods">
                                <h4>Choisir votre moyen de paiement: </h4>
                                <div class="btns">
                                    <button class="btn-card-payement">Carte </button>
                                    <button class="btn-mobile-money"> Mobile money</button>
                                </div>

                                <form action="" id="card-payment">

                                    <div class="ctn-card-name">
                                        <label for="">Nom de titulaire</label>
                                        <input type="text" id="card-name" name="card-name">
                                    </div>
                                    <div class="ctn-card-number">
                                        <label for="card-number">Numero de la carte</label>
                                        <input type="text" id="card-number" name="card-number">
                                    </div>

                                </form>

                                <form action="" id="mobile-payement">
                                    <select name="" id="">
                                        <option value=""></option>
                                    </select>

                                    <div class="ctn-mobile-num">
                                        <input type="text" id="mobile-num" name="mobile-num">
                                    </div>
                                </form>
                                
                            </div>

                            <button class="poursuivre">Poursuivre</button>
                        </div>

                        <div class="step2"></div>

                    </div>
               
                </div>

            </section>


            <!-- container the settings element -->

            <section id="overlay">
                <div id="params">

                    <div class="param-head">
                        <div class="par-head-block1">
                            <h3>Paramètres</h3> 
                                <button class="btn-close-param">
                                <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-x" viewBox="0 0 16 16">
                                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
                                </svg>
                            </button>
                        </div>

                        <div class="par-head-block2">
                            <button class="btn-del-acc-return">
                                <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-chevron-left" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0"/>
                                </svg>
                                <h2>Supprimer le compte</h2>
                            </button>
                        </div>
                        
                    </div>

                    <div class="body">
                        <div class="btns">

                            <div class="info-perso">
                                <button class="btn-info-perso">Informations personnelles 
                                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-chevron-right" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708"/>
                                    </svg>
                                </button>

                                <form action="" method="POST">

                                    <div class="ctn-input ctn-username">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-person-fill" viewBox="0 0 16 16">
                                            <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
                                        </svg>
                                        <input type="text" id="username" name="username" required>
                                    </div>

                                    <div class="ctn-input ctn-email">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-envelope" viewBox="0 0 16 16">
                                            <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1zm13 2.383-4.708 2.825L15 11.105zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741M1 11.105l4.708-2.897L1 5.383z"/>
                                        </svg>
                                        <input type="email" id="email" name="email" required>
                                    </div>

                                    <div class="ctn-input ctn-password">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-lock" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M8 0a4 4 0 0 1 4 4v2.05a2.5 2.5 0 0 1 2 2.45v5a2.5 2.5 0 0 1-2.5 2.5h-7A2.5 2.5 0 0 1 2 13.5v-5a2.5 2.5 0 0 1 2-2.45V4a4 4 0 0 1 4-4M4.5 7A1.5 1.5 0 0 0 3 8.5v5A1.5 1.5 0 0 0 4.5 15h7a1.5 1.5 0 0 0 1.5-1.5v-5A1.5 1.5 0 0 0 11.5 7zM8 1a3 3 0 0 0-3 3v2h6V4a3 3 0 0 0-3-3"/>
                                        </svg>
                                        <input type="password" id="password" name="passowrd" required>
                                    </div>

                                    <button type="submit">Envoyer</button>
                                        
                                </form>

                            </div>
                                
                            <div class="ctn-dev-forma">
                                <button class="btn-dev-forma">Devenir formateur
                                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-chevron-right" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708"/>
                                    </svg>
                                </button>
                            </div>

                            <div class="ctn-del-acc">
                                <button class="btn-del-acc">Supprimer le compte
                                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-chevron-right" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708"/>
                                    </svg>
                                </button>
                            </div>

                        </div>

                        <div class="del-reasons">
                            <h3>Oh! Pourquoi partir maintenant?</h3>
                            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dolorem deleniti tempore dolores reiciendis repellendus odio dolor vel ab reprehenderit doloremque incidunt quaerat pariatur magni eaque esse illo, impedit provident! Error.</p>
                            <form action="">
                                <label for="reasons">Les raisons de votre départ</label>
                                <textarea name="reasons" id="reasons"></textarea>
                            </form>
                            <div class="foot">
                                <button class="btn-del-cancel">Annuler</button>
                                <button class="btn-continue-del-acc">Continuer</button>
                            </div>
                        </div>

                    </div>


                </div>

                <!-- To delete the account  -->

                <div id="del-acc-msg">

                    <div class="del-acc-head">
                        <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-exclamation-triangle" viewBox="0 0 16 16">
                            <path d="M7.938 2.016A.13.13 0 0 1 8.002 2a.13.13 0 0 1 .063.016.15.15 0 0 1 .054.057l6.857 11.667c.036.06.035.124.002.183a.2.2 0 0 1-.054.06.1.1 0 0 1-.066.017H1.146a.1.1 0 0 1-.066-.017.2.2 0 0 1-.054-.06.18.18 0 0 1 .002-.183L7.884 2.073a.15.15 0 0 1 .054-.057m1.044-.45a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767z"/>
                            <path d="M7.002 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0M7.1 5.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0z"/>
                        </svg>
                        <h3>Cette action est irréverssible. </h3>
                        <p>Cette action va supprimer votre compte, Confirmer avec votre mot de passe </p>
                    </div>
                    <form>
                        <label for="del-password">Mot de passe</label>
                        <input type="passowrd" id="del-password" name="del-password" required>
                        <button type="submit" class="btn-del-acc-msg">Supprimer le compte</button>
                    </form>

                </div>

                <!-- TO switch account  -->

                <div id="switch-acc">
                    <div class="switch-acc-head">
                        <h3>Vous rêvez de partager votre savoir</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime libero harum tenetur asperiores!</p>
                    </div>
                    <div class="switch-acc-advantages">
                        <h4>Avantages</h4>
                        <div class="advantage-item">
                            <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-check-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                <path d="m10.97 4.97-.02.022-3.473 4.425-2.093-2.094a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05"/>
                            </svg>
                            Publiez des cours
                        </div>
                        <div class="advantage-item">
                            <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-check-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                <path d="m10.97 4.97-.02.022-3.473 4.425-2.093-2.094a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05"/>
                            </svg>
                            Vendre des cours
                        </div>
                        <div class="advantage-item">
                            <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-check-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                <path d="m10.97 4.97-.02.022-3.473 4.425-2.093-2.094a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05"/>
                            </svg> 
                            Effectuez des retrais d'argent
                        </div>
                        <div class="advantage-item">
                            <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-check-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                <path d="m10.97 4.97-.02.022-3.473 4.425-2.093-2.094a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05"/>
                            </svg>
                            Être connu comme expert du domaine
                        </div>
                    </div>
                    <button class="switch-acc-btn-ctn">Continuer</button>
                </div>

            </section>
    </div>


@endsection