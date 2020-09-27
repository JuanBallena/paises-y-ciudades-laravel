<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Jobs</title>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
</head>
<body>
  <style>
    #style-search-form input {
      box-shadow: none;
    }
    .title {
      color: blue;
      /*text-decoration: none;*/
    }
  </style>
  <div class="container py-2">
    <a href="{{ route('jobs.index') }}">
      <h4 class="title">Jobs</h4>
    </a>
    <hr>
    <div class="card">
      <div class="card-header pb-0">
        <h6><i class="fas fa-search"></i> Search</h6>
        <form action="{{ route('jobs.redirectSearch') }}" method="POST" id="style-search-form">
          @csrf
          <div class="row">
            <div class="col-xl-4 form-group">
              <label for="input1">Title</label>
              <input 
                type="text" 
                name="input_title"
                
                class="form-control js-input-title"
                value=""
                placeholder="Title, description">
            </div>
            <div class="col-xl-4 form-group">
              <label for="input2">Place</label>
              <input 
                type="text" 
                name="input_place" 
                class="form-control js-input-place"
                value=""
            
                placeholder="Country, State, City">
            </div>
            <div class="col-xl-4 form-group">
              <label for="button">*</label>
              <br>
              <button type="submit" class="btn btn-success js-input-search">search</button>
            </div>
          </div>
        </form>
      </div>
    </div>
    <br>

    <h6>Work list</h6>
    <table class="table table-bordered table-sm">
      <thead class="bg-dark text-white">
        <tr>
          <th>Title</th>
          <th>Description</th>
          <th>Country</th>
          <th>State</th>
          <th>City</th>
        </tr>
      </thead>
      <tbody>
        @foreach($jobs as $job)
          <tr>
            <td>{{ $job->title }}</td>
            <td>{{ $job->description }}</td>
            <td>{{ $job->country->name }}</td>
            <td>{{ $job->state->name }}</td>
            <td>{{ $job->city->name }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
  <script>
    $('.js-input-search').click(function(e) {

      let input_title = $('.js-input-title').val();
      let input_place = $('.js-input-place').val();

      if ( !input_title && !input_place ) {
        e.preventDefault();
        alert('Debe escribir al menos en una caja de texto');
      }

    });

  </script>

</body>
</html>