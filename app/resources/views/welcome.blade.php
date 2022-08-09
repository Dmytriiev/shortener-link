<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Link shortening</title>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">

        <style>
            #center {
                position: fixed; /* or absolute */
                top: 10px;
                left: 10px;
                width:  500px;
                height: 100px;
            }
        </style>
    </head>
    <body>
        <div id="center">

            <h1>Link shortening</h1>

            <form id="form-link" method="post" action="{{url('store-link')}}">
                {{ csrf_field() }}

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('shortedLink'))
                    <div class="alert alert-success">
                        Shorted Link: {{ session('shortedLink') }}
                    </div>
                @endif


                <fieldset class="form-group">
                    <label for="link">Your Link</label>
                    <input type="url" name="link" class="form-control" maxlength="255" required placeholder="https://">
                </fieldset>
                <fieldset class="form-group">
                    <label for="limit">Сlick limit</label>
                    <input type="number" name="limit" class="form-control" value="0" min="0">
                </fieldset>
                <fieldset class="form-group">
                    <label for="lifetime">Link lifetime (hours)</label>
                    <input type="number" name="lifetime" class="form-control" min='1' max= '24' value="1" required>
                </fieldset>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </body>
</html>
