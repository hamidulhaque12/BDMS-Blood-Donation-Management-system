<x-backend.layouts.master>
    
    <div class="container-fluid px-4">
        <h1 class="mt-4">Dashboard</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
            <li class="breadcrumb-item active">Donors</li>
            <li class="breadcrumb-item active">Donor-Requests</li>
        </ol>
      
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                NOT APPROVED DONORS
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>BL Group</th>
                            <th>Gender</th>
                            <th>DOB</th>
                            <th>Requested at</th>
                            <th>Action</th>
                        </tr>
                    </thead>
            
                    <tbody>
                        <tr>
                            <td>Tiger Nixon</td>
                            <td>O+</td>
                            <td>Male</td>
                            <td>1988/04/25</td>
                            <td>2011/04/25</td>
                            <td class="d-flex"> 
                                
                                <a href="" title="view" data-toggle="tooltip" data-placement="top" class="btn btn-info btn-sm" style="color: white" ><i class="fa-solid fa-eye"></i></a> 
                                
                                
                                
                                <a href="" title="approve" class="btn btn-success btn-sm" style="margin-left: 3px" ><i class="fas fa-check"></i></a> 

                                <form action="">
                                    <button title="delete" type="submit" class="btn btn-danger btn-sm" style="margin-left: 3px"><i class="fas fa-ban"></i></button>
                                </form> </td>
                        </tr>
                     
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</x-backend.layouts.master>