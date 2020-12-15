<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Property Listing from Wordpress API</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <!-- Styles -->
    <style>

    </style>
</head>
<body>
<div class="container-fluid" style="background-color:#e8e8e8">
    <div class="container container-pad" id="property-listings">
        <div class="row">
            @if(!count($properties))
                <h3 class="text-center text-danger">No Property listings available</h3>
            @endif
            @foreach($properties as $property)
                <div class="col-6 my-2">

                    <!--- property card -->
                    <div class="card">
                        <div class="card-header">
                            <h3>{{$property->title}}</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-4">
                                    <img src="{{$property->featured_media}}" class="w-100">
                                </div>
                                <div class="col-8">
                                    <b>Address:</b> {{ $property->metadata['property_address'][0] }} <br>
                                    <b>Country:</b> {{ $property->metadata['property_country'][0] }} <br>
                                    <b>Rooms:</b> {{ $property->metadata['property_rooms'][0] }} <br>
                                    <b>Bath Rooms:</b> {{ $property->metadata['property_bathrooms'][0] }} <br>
                                    <b>Proce:</b> ${{ $property->metadata['property_price'][0] }} <br>

                                </div>
                            </div>

                            <hr>

                            <div class="row">
                                <div class="col-12">
                                    {!! $property->excerpt !!}
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            @endforeach
        </div>
    </div>
</div>
<script>
    window.properties = {!! $properties !!};
</script>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW"
        crossorigin="anonymous"></script>
</body>
</html>
