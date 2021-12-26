<div class="container">
    <h1 class="h2"> DASHBOARD</h1>



    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <h6 class="mb-3 font-15 text-muted font-weight-normal">Users</h6>
                    <div class="h2 mb-0 font-weight-normal text-right"><?= $getFromU->getUsersCount();?></div>
                    <span data-feather="user"></span>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <h6 class="mb-3 font-15 text-muted font-weight-normal">Groups</h6>
                    <div class="h2 mb-0 font-weight-normal text-right"><?= $getFromU->getGroupsCount();?></div>
                    <span data-feather="users"></span>
                </div>
            </div>
        </div>


    </div>

</div>