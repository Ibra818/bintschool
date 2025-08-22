@extends('index')
<link rel="stylesheet" href="{{ asset('css/formation.css') }}">

<script>
    document.addEventListener('DOMContentLoaded', ()=>{
        const cours = document.querySelectorAll('.formation .content .cours .cour');
        const playingVideo = document.querySelector('.formation .content .video video');

        // playingVideo.querySelector('source').src;

        cours.forEach(cour =>{
            cour.addEventListener('click', (e)=>{
                const courActive = document.querySelectorAll('.formation .content .cours .cour.active');
                if(courActive){
                    courActive.forEach(active =>{
                        active.classList.remove('active')
                    });
                }
                e.currentTarget.classList.add('active');
                playingVideo.querySelector('source').src = cour.querySelector('source').src
            });
        });

    });
</script>

@section('content')
<section class="formation">
    @foreach($formation as $forma)
        <div class="content">
            <div class="video">
                <video poster=" {{ asset('images/image4.png') }}">
                    <source src="#" type="video/mp4">
                </video>
                <div class="progression">
                    <button>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pause-fill" viewBox="0 0 16 16">
                            <path d="M5.5 3.5A1.5 1.5 0 0 1 7 5v6a1.5 1.5 0 0 1-3 0V5a1.5 1.5 0 0 1 1.5-1.5m5 0A1.5 1.5 0 0 1 12 5v6a1.5 1.5 0 0 1-3 0V5a1.5 1.5 0 0 1 1.5-1.5"/>
                        </svg>
                    </button>
                    <div class="progress-bar"></div>
                    <div class="duree">{{ $forma -> duree}} min </div>
                </div>
            </div>
           

            <div class="categorie">{{ $forma -> categorie}}</div>
            <h3>{{ $forma -> nom}}</h3>
            <div class="formateur">
                <div class="info">
                    <img src=" {{ asset('images/image4.png') }}" alt="">
                    <div class="profil">
                        <h4 class="username">{{ $forma -> nom_formateur}}</h4>
                        <div class="specialite"> specialiste marketing digital</div>
                    </div>
                </div>
                <button class="visite">
                    <svg xmlns="http://www.w3.org/2000/svg"class="bi bi-eye-fill" viewBox="0 0 16 16">
                        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/>
                        <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7"/>
                    </svg>
                    Visiter
                </button>
            </div>

                <div class="cours">

                    <div class="cour">
                        <div class="video">
                            <video poster=" {{ asset('images/image2.png') }}">
                                <source src="#" type=""> </source>
                            </video>

                            <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-play-fill" viewBox="0 0 16 16">
                                <path d="m11.596 8.697-6.363 3.692c-.54.313-1.233-.066-1.233-.697V4.308c0-.63.692-1.01 1.233-.696l6.363 3.692a.802.802 0 0 1 0 1.393"/>
                            </svg>

                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pause-fill" viewBox="0 0 16 16">
                                <path d="M5.5 3.5A1.5 1.5 0 0 1 7 5v6a1.5 1.5 0 0 1-3 0V5a1.5 1.5 0 0 1 1.5-1.5m5 0A1.5 1.5 0 0 1 12 5v6a1.5 1.5 0 0 1-3 0V5a1.5 1.5 0 0 1 1.5-1.5"/>
                            </svg>
                        </div>
                        

                        <div class="module">
                            module 1 
                            <div class="modul-progress"> 12%</div>
                        </div>

                        <div class="module-last">7 min</div>
                    </div>

                    <div class="cour">
                        <div class="video">
                            <video poster=" {{ asset('images/image2.png') }}">
                                <source src="#" type=""> </source>
                            </video>

                            <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-play-fill" viewBox="0 0 16 16">
                                <path d="m11.596 8.697-6.363 3.692c-.54.313-1.233-.066-1.233-.697V4.308c0-.63.692-1.01 1.233-.696l6.363 3.692a.802.802 0 0 1 0 1.393"/>
                            </svg>

                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pause-fill" viewBox="0 0 16 16">
                                <path d="M5.5 3.5A1.5 1.5 0 0 1 7 5v6a1.5 1.5 0 0 1-3 0V5a1.5 1.5 0 0 1 1.5-1.5m5 0A1.5 1.5 0 0 1 12 5v6a1.5 1.5 0 0 1-3 0V5a1.5 1.5 0 0 1 1.5-1.5"/>
                            </svg>
                        </div>

                        <div class="module">
                            module 1 
                            <div class="modul-progress"> 12%</div>
                        </div>

                        <div class="module-last">7 min</div>
                    </div>

                    <div class="cour">
                        <div class="video">
                            <video poster=" {{ asset('images/image2.png') }}">
                                <source src="#" type=""> </source>
                            </video>

                            <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-play-fill" viewBox="0 0 16 16">
                                <path d="m11.596 8.697-6.363 3.692c-.54.313-1.233-.066-1.233-.697V4.308c0-.63.692-1.01 1.233-.696l6.363 3.692a.802.802 0 0 1 0 1.393"/>
                            </svg>

                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pause-fill" viewBox="0 0 16 16">
                                <path d="M5.5 3.5A1.5 1.5 0 0 1 7 5v6a1.5 1.5 0 0 1-3 0V5a1.5 1.5 0 0 1 1.5-1.5m5 0A1.5 1.5 0 0 1 12 5v6a1.5 1.5 0 0 1-3 0V5a1.5 1.5 0 0 1 1.5-1.5"/>
                            </svg>
                        </div>

                        <div class="module">
                            module 1 
                            <div class="modul-progress"> 12%</div>
                        </div>

                        <div class="module-last">7 min</div>
                    </div>
                </div>
        </div>
        
    @endforeach
</section>
    
@endsection