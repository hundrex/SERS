<div class="row filter-bar">
    <div class="col-lg-6">
        <div class="input-group">
            <select class="form-control">
                <option value="All">All</option>
                <option value="10">10</option>
                <option value="20">20</option>
                <option value="50">50</option>
            </select>
            <span class="input-group-addon" id="sizing-addon1">Items per page</span>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Search for...">
            <span class="input-group-btn">
                <button class="btn btn-default" type="button">Go!</button>
            </span>
        </div>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">User list</div>

    <table class="table">
        <tr><th>Last Name</th><th>First Name</th><th>Birth date</th><th>User Type</th><th></th></tr>
        <tr><td>Commandant</td><td>Cousteau</td><td>-104AD</td><td>Root</td>
            <td>
                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modalViewUserList">
                    <span class="glyphicon glyphicon-eye-open"></span></button>
            </td>
        </tr>
        <tr><td>Batman</td><td>Batman</td><td>1895</td><td>Administration</td>
            <td>
                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modalViewUserList">
                    <span class="glyphicon glyphicon-eye-open"></span></button>
            </td>
        </tr>
        <tr><td>Jones</td><td>Indiana</td><td>1910</td><td>Teacher</td>
            <td>
                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modalViewUserList">
                    <span class="glyphicon glyphicon-eye-open"></span></button>            
            </td>
        </tr>
        <tr><td>Durden</td><td>Taylor</td><td>1950</td><td>Student</td>
            <td>
                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modalViewUserList">
                    <span class="glyphicon glyphicon-eye-open"></span></button>           
            </td>
        </tr>
    </table>
</div>

<nav class="center">
    <ul class="pagination" >
        <li>
            <a href="#" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
            </a>
        </li>
        <li><a href="#">1</a></li>
        <li><a href="#">2</a></li>
        <li><a href="#">3</a></li>
        <li><a href="#">4</a></li>
        <li><a href="#">5</a></li>
        <li>
            <a href="#" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
            </a>
        </li>
    </ul>
</nav>

<!--modal-->


<div class="modal fade" id="modalViewUserList" tabindex="-1" role="dialog" aria-labelledby="modalViewUserList">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="modalViewUserList">User view</h4>
            </div>
            <div class="modal-body">
               User details
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-info" data-dismiss="modal">Edit</button>
            </div>
        </div>
    </div>
</div>