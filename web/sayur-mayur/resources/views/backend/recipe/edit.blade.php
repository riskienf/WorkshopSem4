@extends('backend.layout.master')
@section('content')
<div class="page-wrapper" style="min-height: 250px;">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb bg-white">
        <div class="row align-items-center">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">{{ $title }}</h4>
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <div class="d-md-flex">
                    <ol class="breadcrumb ms-auto">
                        <li><a href="#" class="fw-normal">{{ $title }}/{{ $subtitle }}</a></li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-md-12">
                <div class="white-box">
                    @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <strong>Terjadi kesalahan!</strong>&nbsp;{{ session('error') }}.
                    </div>
                    @endif
                    <h3 class="box-title">{{ $subtitle }}</h3>
                    <a href="{{ $top_button }}" class="btn btn-primary text-white">
                        Lihat Data
                    </a>
                    <form class="mt-4" action="{{ route('recipe.update', $recipe->recipe_code) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="formResep">Kode Resep</label><span class="text-danger">*</span>
                                    <input type="text" class="form-control" id="formResep" name="recipe_code" value="{{ old('recipe_code', $recipe->recipe_code) }}" placeholder="ex : RC001" value="{{ old('recipe_code') }}" readonly>
                                    @error('recipe_code')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="isVisible">Tampilkan</label><span class="text-danger">*</span>
                                    <select name="is_visible" id="isVisible" class="form-control">
                                        <option value="1" {{ $recipe->is_visible == 1 ? 'selected' : '' }}>Ya</option>
                                        <option value="0" {{ $recipe->is_visible == 0 ? 'selected' : '' }}>Tidak</option>
                                    </select>
                                    @error('is_visible')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="formNama">Nama Resep</label><span class="text-danger">*</span>
                                    <input type="text" class="form-control" id="formNama" name="recipe_name" placeholder="ex : Pecel" value="{{ old('recipe_name', $recipe->name) }}">
                                    @error('recipe_name')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="formCover">Sampul</label>
                                    <input type="file" name="cover" id="formCover" class="form-control">
                                    @if ($recipe->cover != null)
                                    <a style="cursor: pointer;" data-toggle="modal" class="showDetailData" data-target=".modal-show-detail" data-image="{{ url(''.$recipe->cover) }}">
                                        <img src="{{ url(''.$recipe->cover) }}" class="rounded mt-2 mb-2" alt="{{ $recipe->name }}" width="80" height="80">
                                    </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="formStock">Stok</label><span class="text-danger">*</span>
                                    <input type="number" class="form-control" id="formStock" name="stock" placeholder="ex : 20" value="{{ old('stock', $recipe->stock) }}">
                                    @error('stock')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="formLaba">Laba(Rp)</label><span class="text-danger">*</span>
                                    <input type="number" class="form-control" id="formLaba" name="laba" placeholder="ex : 7,000.00" value="{{ old('laba', $recipe->price) }}">
                                    @error('laba')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        {{-- @include('backend.recipe.create-detail') --}}
                        <div class="form-inline">
                            <input type="submit" value="Simpan" class="btn btn-success mr-2">
                            <input type="reset" value="Batal" class="btn btn-danger">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End PAge Content -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Right sidebar -->
        <!-- ============================================================== -->
        <!-- .right-sidebar -->
        <!-- ============================================================== -->
        <!-- End Right sidebar -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- footer -->
    <!-- ============================================================== -->
    <footer class="footer text-center"> 2021 © Ample Admin brought to you by <a
            href="https://www.wrappixel.com/">wrappixel.com</a>
    </footer>
    <!-- ============================================================== -->
    <!-- End footer -->
    <!-- ============================================================== -->
</div>
<div class="modal modal-show-detail">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          {{-- <h6 class="modal-title">Detail Data</h6> --}}
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body text-center">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-12">
                <img alt="" id="showDetail" width="100%">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection