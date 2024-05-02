@php
  use App\Models\Customer;
  use App\Http\Controllers\UserController;
  use App\Http\Controllers\ReviewController;
  use Illuminate\Support\Facades\Auth;
 
@endphp

@extends('layouts/base_app')

@section('full_name')
  {{auth()->user()->full_name}}
@endsection

@section('profile_name')
  {{auth()->user()->full_name}}
@endsection

@section('profile_email')
  {{auth()->user()->email}}
@endsection

@section('content')
    <div class="content-wrapper">
      <div class="row">
        <div class="col-sm-12">
          <div class="home-tab">
            <div class="tab-content tab-content-basic">
              <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview"> 
          			
                <!--affichage des messages de success ou d'erreur-->

                    @if(session('success'))
                      <div class="row">
                        <div class="col-lg-12">
                          <div class="col-md-3"></div>
                          <div class="card card-body grid-margin ">
                              <div class="bg-success">{{session('success')}}</br></div>

                            </div>
                          <div class="col-md-3"></div>
                        </div>
                      
                      </div>  
     
                    @endif

                  @if(session('error'))
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="col-md-3"></div>
                        <div class="card card-body grid-margin">
                          <div class="bg-danger">{{session('error')}}</br></div>

                          </div>
                        <div class="col-md-3"></div>
                      </div>
                    
                    </div>  
                    
                    
                  @endif  
                
                <!-- fin-->
                <div class="row">
                  <div class="col-lg-12 d-flex flex-column">
                    <div class="row flex-grow">
                        <div class="col-md-6 grid-margin">
                          <div class="card">
                            <div class="card-body">
                              <h4 class="card-title">@lang('titles.form_add_review')</h4>
                              
                              <form class="forms-sample" action="addreview" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                  <label class="col-sm-3 col-form-label">@lang('titles.form.Title')</label>
                                  <div class="col-sm-9">
                                    <input type="text" class="form-control" placeholder="exeample: press review of 12/03/2023" name="title" required>
                                  </div>
                                </div>
                                <div class="form-group row">
                                  <label class="col-sm-3 col-form-label">@lang('titles.form.French_upload')</label>
                                  <div class="col-sm-9">
                                    <input type="file" class="form-control form-control-lg" name="fr_file" >
                                  </div>
                                </div>
                                <div class="form-group row">
                                  <label class="col-sm-3 col-form-label">@lang('titles.form.English_upload')</label>
                                  <div class="col-sm-9">
                                    <input type="file" class="form-control form-control-lg" name="en_file">
                                  </div>
                                </div>
                                <button type="submit" class="btn btn-success me-2">@lang('actions.Submit')</button>
                                <button class="btn btn-light" type="reset">@lang('actions.Cancel')</button>
                              </form>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6 grid-margin">
                          <div class="card">
                            <div class="card-body">
                              <h4 class="card-title">@lang('titles.form_add_article')</h4>
                              
                              <form class="forms-sample" action="addartcile" method="post">
                                @csrf
                                <div class="form-group row">
                                  <label class="col-sm-3 col-form-label">@lang('titles.form.English Title')</label>
                                  <div class="col-sm-9">
                                    <textarea  class="form-control" name="en_title" required></textarea>
                                  </div>
                                </div>
                                <div class="form-group row">
                                  <label class="col-sm-3 col-form-label">@lang('titles.form.French Title')</label>
                                  <div class="col-sm-9">
                                    <textarea  class="form-control" name="fr_title" required></textarea>
                                  </div>
                                </div>
                               <div class="form-group row">
                                  <label class="col-sm-3 col-form-label">@lang('titles.form.Select the Press')</label>
                                  <div class="col-sm-9">
                                    <select class="form-control form-control-lg" name="press" required>
                                      @php
                                        $query = (new ReviewController())->displayAllNewsPaper();
                                      @endphp
                                      @foreach($query as $get)
                                        <option value="{{$get->id_presse}}">{{$get->name_presse}}</option>
                                      @endforeach
                                    </select>
                                  </div>
                                </div>
                                <div class="form-group row">
                                  <label class="col-sm-3 col-form-label">@lang('titles.form.Url_of_artcicle')</label>
                                  <div class="col-sm-9">
                                    <input type="text" class="form-control"  placeholder="https://journalci.press/artciledu7_12_2021..." name="url" required>
                                  </div>
                                </div>
                                <div class="form-group row">
                                  <label class="col-sm-3 col-form-label">@lang('titles.form.Select_review') </label>
                                  <div class="col-sm-9">
                                    <select class="form-control form-control-lg" name="rv" required>
                                      @php
                                        $query = (new ReviewController())->displayAllReviews();
                                      @endphp
                                      @foreach($query as $get)
                                        <option value="{{$get->id}}">{{$get->label}}</option>
                                      @endforeach
                                    </select>
                                  </div>
                                </div>
                                <button type="submit" class="btn btn-warning me-2">@lang('actions.Submit')</button>
                                <button class="btn btn-light" type="reset">@lang('actions.Cancel')</button>
                              </form>
                            </div>
                          </div>
                        </div>
                        
                        
                    </div>
                    
                  </div>
                  
                </div>
             
                <div class="row">
                   <div class="col-md-4 grid-margin">
                      <div class="card">
                        <div class="card-body">
                          <h4 class="card-title">@lang('titles.form_add_newspaper')</h4>
                          
                          <form class="forms-sample" action="addnewspaper" method="post">
                            @csrf
                            <div class="form-group row">
                              <label class="col-sm-3 col-form-label">@lang('titles.form.name_newspaper')</label>
                              <div class="col-sm-9">
                                <input type="text" class="form-control" placeholder="Ex: Abidjan.net" name="name_newspaper" required onkeyup="this.value=this.value.toUpperCase();">
                              </div>
                            </div>
                            <div class="form-group row">
                              <label class="col-sm-3 col-form-label">@lang('titles.form.web')</label>
                              <div class="col-sm-9">
                                <input type="text" class="form-control form-control-lg" name="web" required>
                              </div>
                            </div>
                           
                            <button type="submit" class="btn btn-primary me-2">@lang('actions.Submit')</button>
                            <button class="btn btn-light" type="reset">@lang('actions.Cancel')</button>
                          </form>
                        </div>
                      </div>
                    </div>
                       
                   <div class="col-lg-8 d-flex flex-column">
                    <div class="row flex-grow">
                      <div class="col-12 col-lg-4 col-lg-12 grid-margin ">
                      <div class="card card-rounded">
                        <div class="card-body">
                        <div class="d-sm-flex justify-content-between align-items-start">
                          <div class="table-responsive">
                           <h4 class="card-title card-title-dash">@lang('titles.tables.press_review_table')</h4>
                          <table id="example" class="table table-striped table-bordered" style="width:100%">
                            @php
                              $all = (new ReviewController())->displayAllReviews();
                            @endphp
                            <thead>
                              <tr>
                                <th>@lang('titles.tables.title_press')</th>
                                <th>@lang('titles.tables.Date Added')</th>
                                <th>@lang('titles.tables.Hour')</th>
                              
                                <th>@lang('titles.tables.Action')</th>
                                
                              </tr>
                            </thead>
                            <tbody>
                              @foreach($all as $all)

                                <tr>
                               
                                  <td><form method="post" action="details">@csrf<input type="text" value="{{$all->id}}" name="id" style="display: none;"><button type="submit" class="btn btn-inverse-secondary">{{$all->label}}</button></form></td>
                                  <td>{{$all->date_added}}</td>
                                   <td>
                                    {{$all->hour_added}}
                                   </td>
   
                                    <td align="center">

                                      <form action="deletereview" method="post">
                                        @csrf
                                        <input type="text" name="id" value="{{$all->id}}" style="display: none;">
                                        <button class="btn btn-danger"><span class="mdi mdi-trash-can" style="color:#fff;"></span></button>
                                      </form>
                                      
                                      <form action="editViewForPressReview" method="post">
                                        @csrf
                                        <input type="text" name="id_press_review" value="{{$all->id}}" style="display: none;">
                                       <button class="btn btn-primary"><span class="mdi mdi-pen" style="color:#fff;">
                                      </form>
                                     </span></button>
                                    </td>


                                </tr>
                              @endforeach
                             
                            </tbody>
                            <tfoot>
                              <tr>
                              <th>@lang('titles.tables.title_press')</th>
                                <th>@lang('titles.tables.Date Added')</th>
                                <th>@lang('titles.tables.Hour')</th>
                              
                                <th>@lang('titles.tables.Action')</th>
                              </tr>
                            </tfoot>
                          </table>

                          </div>

                        </div>

                        </div>
                      </div>
                      </div>
                    </div>
                    </div>
                  
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- content-wrapper ends -->

@endsection
       

