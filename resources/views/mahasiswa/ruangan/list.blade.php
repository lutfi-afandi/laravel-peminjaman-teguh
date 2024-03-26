<div class="col-md-8 col-md-offset-2">
    @foreach ($ruangans as $ruangan)
        <div class="panel row">
            <div class="">
                @if ($ruangan->foto_ruangan)
                    <div class="widget-products-item col-xs-12 col-sm-6 col-md-4 col-xl-3 m-b-0 p-l-0">
                        <a href="#" class="widget-products-image">
                            <img src="{{ asset('storage/ruangans/' . $ruangan->foto_ruangan) }}">
                            <span class="widget-products-overlay"></span>
                        </a>
                    </div>
                    {{-- <img src="{{ asset('storage/ruangans/' . $ruangan->foto_ruangan) }}" alt=""
                            class="rounded col-md-4" style="max-width: 250px"> --}}
                @else
                    <div class="widget-products-item col-xs-12 col-sm-6 col-md-4 col-xl-3 m-b-0 p-l-0">
                        <a href="#" class="widget-products-image">
                            <img
                                src="https://png.pngtree.com/png-vector/20190820/ourmid/pngtree-no-image-vector-illustration-isolated-png-image_1694547.jpg">
                            <span class="widget-products-overlay"></span>
                        </a>
                    </div>
                @endif
            </div>
            <div class="col-md-6">
                <div class="widget-notifications-item">
                    <div class="widget-notifications-title text-primary font-size-18">{{ $ruangan->nama_ruangan }}
                    </div>
                    <div class="widget-notifications-description">
                        <i class="fa fa-location-dot"></i> {{ $ruangan->gedung->nama }} - Lantai
                        {{ $ruangan->lantai }}
                    </div>
                    <div class="widget-notifications-description m-t-1"><strong>Kapasitas</strong>:
                        {{ $ruangan->kapasitas }} Orang</div>
                    <div class="widget-notifications-description"><strong>Luas</strong>:
                        {{ $ruangan->luas }} Meter&sup2;</div>
                    <div class="widget-notifications-description"><strong>Tipe</strong>:
                        {{ $ruangan->tipe }} Orang</div>
                    <button class="btn btn-primary btn-sm m-t-1">Booking</button>
                </div>
            </div>
        </div>
    @endforeach

</div>
<div class="col-md-12">
    <div class="text-center">
        {{ $ruangans->links() }}

    </div>
</div>
