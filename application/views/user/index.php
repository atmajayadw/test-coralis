<div class="container mt-3">
    <nav class="navbar navbar-dark bg-dark">
    <a class="navbar-brand">Coralis</a>
   
    <a class="btn btn-outline-danger my-2 my-sm-0" href="<?= base_url('auth/logout'); ?>">Logout</a>
    </nav>

  <div class="jumbotron mt-4">
      <h1 class="display-4">Hello, <?= $user['name']; ?>!</h1>
  </div>
  
  <div class="card m-auto" style="width: 18rem;">
    <img src="<?= base_url('uploads/') . $user['profile_picture']; ?>" class="card-img-top" alt="...">
    <ul class="list-group list-group-flush">
      <li class="list-group-item">Name  : <?= $user['name']; ?></li>
      <li class="list-group-item">Email : <?= $user['email']; ?></li>
  </ul>
  </div>

</div>