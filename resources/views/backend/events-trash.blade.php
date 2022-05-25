<x-backend.layouts.master>
    
    <div class="container-fluid px-4">
        <h1 class="mt-4">Deleted events</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">
                Dashboard
            </li>
            <li class="breadcrumb-item active">
                Events
            </li>
            <li class="breadcrumb-item active">    
                Trash
            </li>
        </ol>
      
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Deleted Events
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Added by</th>
                            <th>Added time</th>
                            <th>Deleted by</th>
                            <th>Action</th>
                        </tr> 
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Tiger Nixon</td>
                            
                            <td>Male</td>
                            <td>1988/04/25</td>
                            <td>Dhaka</td>
                            
                            <td>2011/04/25</td>
                            <td class="d-flex"> 
                                
                                <a href="" title="restore" class="btn btn-info btn-sm" style="color: white" ><i class="fa-solid fa-trash-restore"></i></a> 
                                <form action="">
                                    <button type="submit"  title="delete" class="btn btn-danger btn-sm" style="margin-left: 3px"><i class="fas fa-trash"></i></button>
                                </form> </td>
                        </tr>
                     
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</x-backend.layouts.master>