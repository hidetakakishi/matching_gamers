@extends('layout.default')
  <!-- Styles -->
  <style>
  .flex-center {
      align-items: center;
      display: flex;
      justify-content: center;
  }

  .position-ref {
      position: relative;
  }

  .full-height {
      height: 100vh;
  }

  .content {
      text-align: center;
  }

  .input-text{
      margin-top: 10px;
      margin-bottom: 10px;
  }

  </style>

  <div class="flex-center position-ref full-height">
    <div class="content">
      Mathing Gamers Login.
      <div class="input-text">
        <input type="text" placeholder="mail" class="form-control" />
      <div>
        <div class="input-text">
          <input type="text" placeholder="password" class="form-control" />
        </div>
      <button class="btn btn-primary">
        login
      </button>
      <button class="btn btn-primary">
        create
      </button>
    </div>
  </div>
