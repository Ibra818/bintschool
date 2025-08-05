@extends('index')

@section('content')
    <style>
        :root{
            --primary:rgba(5,7,21,255);
            --border: #222430;
            --block: rgba(27, 29, 50, 1);
            --lite: rgba(197, 199, 222, 1);
            --secondary: #212121ff;
            --tertiaire: #2224309f;
        }
        html,body{
            height:100%;
        }

        main{
            position:fixed;
            top:0;
            height:100%;
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
            height: 8%;
            width:85%;
            display:flex;
            justify-content: flex-start;
            align-items: center;
            border-radius:10px;
            padding: 0 0 0 5%;
            margin: 5% 0 2% 0;
            cursor:pointer;
            list-style-type: none;
        }

        nav ul li svg{
            width:20px;
            height:20px;
            fill:white;
            stroke:white;
            margin: 0 5% 0 0;
        }

        #logout{
            margin: 0 5% 0 5%;
            border-radius: 10px;
            background-color: var(--block);
            height: 5vh;
            color: var(--lite);
            border:none;
        }

        #blockpage{
            display:flex;
            background-color: var(--secondary);
            height:100%;
            flex:10;
            z-index: 2;
            padding: 0% 0 2% 0;
        }

        #blockpage #categories ul{
            color: orange;
            display:flex;
            flex-direction: column;
            justify-content: space-between;
            width:90%;
            height:100%;
            padding: 10% 0 5% 5%;
            overflow-y: scroll;
            scrollbar-width:none;
        }

        #categories ul li{
            width:70%;
            color: #797979ff;
            list-style-type: none;
            cursor:pointer;
            position: relative;
        }

        #categories ul li.active{
            color: white;
        }

        #blockpage #categories ul li.active::before{
            content: '';
            border-radius: 10px;
            /* margin: 0 2% 0 0; */
            border-left: 5px solid white;
            background-color:orange;
        }
        
        #blockpage #categories ul li::before{
            content: '';
            border-radius: 10px;
            margin: 0 5% 0 0;
            border-left: 5px solid white;
            background-color:white;
        }

        #categories{
            flex:2;
            border:1px solid white;
        }


        #blockpage aside{
            flex:3;
            display:flex;
            flex-direction: column;
            justify-content:space-between;
            align-items: center;
            border:1px solid white;
        }

        #blockpage aside .search{
            width: 85%;;
            display:flex;
            justify-content: space-between;
            align-items: center;
            margin: 5% 0 0 0;
        }

        #blockpage aside .search .input-container{
            display:flex;
            justify-content:space-around;
            align-items:center;
            border-radius:15px;
            width: 73%;
            height: 6vh;
            padding: 0 0 0 4%;
            border:2px solid #8a8a8aff;
        }

        #blockpage aside .search .input-container input{
            background-color: var(--secondary);
            border:none;
            width:80%;
            height:90%;
            color:white;
        }

        #blockpage aside .search .input-container input:focus{
            outline:none;
            color:white;
        }

        #blockpage aside .search .btn-search{
            height:100%;
            border-radius: 10px;
            font-weight:400;
            background-color: orange;
        }

        #blockpage aside .search .input-container svg{
            fill:white;
            width:25px;
            height:25px;
        }

        #suggestions{
            height:100%;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            align-items: center;
            overflow-y: scroll;
            margin: 5% 0 0 0;
            scrollbar-width:none;
        }

        #suggestions .video{
            width: 45%;
            height:35%;
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
            border:1px solid white;
            scrollbar-width:none;
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
            border:1px solid white;
        }

        #content .content-item .text{
            background: linear-gradient(to top, var(--primary), transparent);
            color:white;
            z-index:2;
            height:30%;
            width: 100%;
            bottom:10%;
        }
        
        #content .content-item video{
            width:100%;
            height:80%;
            object-fit:cover;
        }

        #content .content-item .text .user{
            height: 25%;
            width: 80%;
            display:flex;
            flex-direction: row;
            justify-content: space-around;
            align-items: center;
            margin: 0 0 1% 0;
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
            border: 1px solid white;
            width: 40%;
            height:20%;
            display:flex;
            flex-direction: row;
            justify-content: space-around;
            align-items: center;
            position:absolute;
            bottom:35%;
            right:5%;
        }

        #content .content-item .text .btns button::before{
            background-color:white;
            opacity: 0.5;
            content: '';
        }

        #content .content-item .text .btns button{
            width: 30%;
            max-height:90%;
            border:1px solid white;
            backdrop-filter:  blur(1px);
            background-color:transparent;
        }

        #content .content-item .text .btns button svg{
            fill:white;
            width:25px;
            height:25px;
        }

        #content .content-item .text .more{
            border:1px solid white;
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
            border: 1px solid white;
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
            opacity: 0.6;
        }


    </style>

    <script>

        document.addEventListener('DOMContentLoaded', function(){

            const main = document.querySelector('main');
            main.style.cssText += 'display:flex; width:100%; height:100%;';

        });

    </script>

    <nav>
        <div class="nav-head">
            <img src="https://www.bintschool.com/wp-content/uploads/2023/04/BintSchooloff.png" alt="" class="logo">
        </div>
        <div class="pages">
            <ul>
                Menu
                <li>
                    <svg xmlns="http://www.w3.org/2000/svg"  class="bi bi-house" viewBox="0 0 16 16">
                        <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5z"/>
                    </svg>
                    Pour toi
                </li>

                <li>
                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-person-fill" viewBox="0 0 16 16">
                        <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
                    </svg>
                    Profil
                </li>

                <li>
                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-chat-left-dots" viewBox="0 0 16 16">
                        <path d="M14 1a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H4.414A2 2 0 0 0 3 11.586l-2 2V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12.793a.5.5 0 0 0 .854.353l2.853-2.853A1 1 0 0 1 4.414 12H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z"/>
                        <path d="M5 6a1 1 0 1 1-2 0 1 1 0 0 1 2 0m4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0m4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0"/>
                    </svg>
                    Messagerie</li>
                <li>
                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-book-fill" viewBox="0 0 16 16">
                        <path d="M8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783"/>
                    </svg>    
                    Formation suivies
                </li>

            </ul> 
        </div>
        

        <button id="logout">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-in-right" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0z"/>
                <path fill-rule="evenodd" d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z"/>
            </svg>    
        logout</button>
    </nav>

    <section id="blockpage">
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
                <video src="#"  muted poster="{{ asset('images/image2.png') }}" preload="auto"></video>
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
                        
                        <button class="btn-follow">suivre +</button>
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
                <video src="{{ asset('images/image2.png') }}" width="80%" height="90%"  muted poster="" preload="auto"></video>
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
                        
                        <button class="btn-follow">suivre +</button>
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
                <video src="{{ asset('images/image2.png') }}" width="80%" height="90%"  muted poster="" preload="auto"></video>
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
                        
                        <button class="btn-follow">suivre +</button>
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
                <video src="{{ asset('images/image2.png') }}" width="80%" height="90%"  muted poster="" preload="auto"></video>
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
                        
                        <button class="btn-follow">suivre +</button>
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

@endsection