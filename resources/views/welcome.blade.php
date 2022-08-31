<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="http://fonts.cdnfonts.com/css/roboto" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"> -->

    <link href="{{asset('/')}}css/style.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
        
        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script> -->
    <!------ Include the above in your HEAD tag ---------->

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <!-- <script src="http://getbootstrap.com/dist/js/bootstrap.min.js"></script> -->

    <!-- Styles -->
    <style>
        /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */
        /* html {
            line-height: 1.15;
            -webkit-text-size-adjust: 100%
        }

        body {
            margin: 0
        } */
       
    </style>

</head>

<body class="antialiased">

    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <p class="title1 mt-5 mb-4">Top Secret CIA database</p>

                <form class="row g-3" id="searchform" name="searchform" method="GET">
                    <div class="col-md-2">
                        <label for="birth_year" class="form-label">Birth year</label>
                        <input type="text" class="form-control filter_field" value="{{request()->input('birth_year')}}" name="birth_year" id="birth_year">
                    </div>
                    <div class="col-md-2">
                        <label for="birth_month" class="form-label">Birth month</label>
                        <input type="text" class="form-control filter_field" value="{{ request()->input('birth_month') }}" name="birth_month" id="birth_month">
                    </div>
                    <div class="col-md-2">
                        <label for="apply_filter" class="form-label">&nbsp;</label>
                        <button type="submit" id="apply_filter" class="btn btn-filter d-flex align-items-end">Filter</button>
                    </div>
                </form>

                <div class="table-responsive datalist_table mt-4">
                    <div class="d-flex justify-content-end">        
                        <span class="data_count px-2 d-flex align-items-center">{{ $persons->appends($_GET)->links('pagination') }}</span>                    
                    </div>    
                    <table id="mytable" class="mt-2 table">

                        <thead>

                            <th><input type="checkbox" id="checkall" /></th>
                            <th>Email</th>
                            <th>ID</th>
                            <th>Tags</th>
                            <th>Full name</th>
                            <th>Location</th>
                            <th>Year</th>
                            <th>Month</th>
                        </thead>
                        <tbody>
                            @foreach ($persons as $person)                                                    
                            <tr>
                                <td><input type="checkbox" class="checkthis" /></td>
                                <td>{{ $person->email }}</td>
                                <td>{{ $person->id }}</td>
                                <td><span class="badge rounded-pill bg-light text-dark">Customers</span><span class="badge rounded-pill bg-light text-dark">Oldtimer</span> </td>
                                <td>{{ $person->name }}</td>
                                <td>{{ $person->country }}</td>
                                <td><?php echo substr($person->birthday,0,4); ?></td>
                                <td><?php echo substr($person->birthday,5,2); ?></td>
                            </tr>
                            @endforeach
                            
                        </tbody>

                    </table>

                    <div class="clearfix"></div>
                    <div class="d-flex justify-content-end p-3">                         
                        <span class="data_count px-2 d-flex align-items-center">{{ $persons->appends($_GET)->links('pagination') }}</span>                   
                    </div>

                </div>

            </div>
        </div>
    </div>


    <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                    <h4 class="modal-title custom_align" id="Heading">Edit Your Detail</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input class="form-control " type="text" placeholder="Mohsin">
                    </div>
                    <div class="form-group">

                        <input class="form-control " type="text" placeholder="Irshad">
                    </div>
                    <div class="form-group">
                        <textarea rows="2" class="form-control" placeholder="CB 106/107 Street # 11 Wah Cantt Islamabad Pakistan"></textarea>


                    </div>
                </div>
                <div class="modal-footer ">
                    <button type="button" class="btn btn-warning btn-lg" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span> Update</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>



    <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                    <h4 class="modal-title custom_align" id="Heading">Delete this entry</h4>
                </div>
                <div class="modal-body">

                    <div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign"></span> Are you sure you want to delete this Record?</div>

                </div>
                <div class="modal-footer ">
                    <button type="button" class="btn btn-success"><span class="glyphicon glyphicon-ok-sign"></span> Yes</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> No</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <script>
        $(document).ready(function() {
            $("#mytable #checkall").click(function() {
                if ($("#mytable #checkall").is(':checked')) {
                    $("#mytable input[type=checkbox]").each(function() {
                        $(this).prop("checked", true);
                    });

                } else {
                    $("#mytable input[type=checkbox]").each(function() {
                        $(this).prop("checked", false);
                    });
                }
            });

            $("[data-toggle=tooltip]").tooltip();
        });
    </script>
</body>

</html>