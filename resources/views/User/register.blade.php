<form action="register" method="post" enctype="multipart/form-data">
    @csrf
    @method('post')

    <div class="form-group">
        <label for="name">name</label>
        <input type="text" name="name" class="form-control" placeholder="Enter name">
    </div>
    <div class="form-group">
        <label for="email">email</label>
        <input type="text" name="email" class="form-control" placeholder="Enter email">
    </div>
    <div class="form-group">
        <label for="password">password</label>
        <input type="text" name="password" id="password" class="form-control" placeholder="Enter password">
    </div>
    <div class="form-group" hidden>
        <label for="role_id">role_id</label>
        <input type="number" name="role_id" id="role_id" value="2" class="form-control"
            placeholder="Enter Harga">
    </div>

    <button> Submit</button>
</form>
