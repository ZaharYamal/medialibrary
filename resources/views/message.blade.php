@if($errors->any())
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 pd-10 tx-center">
            <div class="alert alert-danger pd-y-20 mg-b-0" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="d-sm-flex align-items-center justify-content-start">
                    <i class="icon ion-ios-close alert-icon tx-52 tx-danger mg-r-20"></i>
                    <div class="mg-t-20 mg-sm-t-0">
                        <h5 class="mg-b-2 tx-danger">Ошибка ! Что то пошло не так !</h5>

                        @foreach($errors->all() as $error)
                            <li class="mg-b-0 tx-gray">{{$error}}</li>
                        @endforeach

                    </div>
                </div><!-- d-flex -->
            </div><!-- alert -->
        </div>
    </div>
    </div>
@endif

@if(session('success'))
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 pd-10 tx-center">
            <div class="alert alert-success pd-y-20" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="d-sm-flex align-items-center">
                    <i class="icon ion-ios-checkmark alert-icon tx-52 mg-r-20 tx-success"></i>
                    <div class="mg-t-20 mg-sm-t-0">
                        <h5 class="mg-b-2 tx-success">Успешно !!!</h5>
                        <p class="mg-b-0 tx-gray">{{session()->get('success')}}</p>
                    </div>
                </div><!-- d-flex -->
            </div><!-- alert -->
        </div>
    </div>
    </div>
@endif
