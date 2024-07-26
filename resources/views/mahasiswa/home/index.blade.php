@extends('layouts.tabler-front.master')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">

                <style>
                    .chead {
                        position: relative;
                        min-width: 350px;
                        min-height: 240px;
                        background-image: url('https://radarlampung.disway.id/upload/2f4af8781547a9d7097a689dd61e4e4e.jpg');
                        background-size: cover;
                        background-position: center;
                        display: flex;
                        justify-content: center;
                        align-items: center;
                        color: white;
                        overflow: hidden;
                    }

                    .chead::before {
                        content: '';
                        position: absolute;
                        top: 0;
                        left: 0;
                        width: 100%;
                        height: 100%;
                        background: rgba(0, 0, 0, 0.5);
                        /* Overlay yang lebih gelap */
                        z-index: 1;
                    }

                    .chead h5 {
                        position: relative;
                        z-index: 2;
                        font-size: 5vw;
                        /* Ukuran font responsif */
                        margin: 0;
                    }
                </style>
                <div class="card-body chead">
                    <h5>Pilih Peminjaman</h5>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6  mt-2">
            <a href="{{ route('aset') }}">

                <div class="card"
                    style="min-height: 144px; justify-content: center;
                        align-items: center;background: rgb(131,58,180);
background: linear-gradient(133deg, rgba(131,58,180,1) 0%, rgba(196,6,6,1) 50%, rgba(252,109,69,1) 100%);">
                    <img src="{{ asset('img/loudspeaker.png') }}" alt="" width="88px"
                        style="filter: brightness(0) invert(1);" class="mt-2">
                    </svg>
                    <h3 class="text-white">Barang</h3>

                </div>
            </a>
        </div>
        <div class="col-md-6  mt-2">
            <a href="/ruangan">
                <div class="card"
                    style="min-height: 144px; justify-content: center;
                        align-items: center; background: rgb(131,58,180);
background: linear-gradient(321deg, rgba(131,58,180,1) 0%, rgba(196,6,6,1) 50%, rgba(252,109,69,1) 100%);">
                    <img src="{{ asset('img/cinema.png') }}" alt="" width="88px"
                        style="filter: brightness(0) invert(1);" class="mt-2">
                    </svg>
                    <h3 class="text-white">Ruangan</h3>

                </div>
            </a>
        </div>

    </div>
@endsection
