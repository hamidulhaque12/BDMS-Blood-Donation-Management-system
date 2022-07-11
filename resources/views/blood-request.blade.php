<x-frontend.layouts.master>
    <div class="container" style='margin-top:70px;'>
        @if (session('message'))
            <p class="alert alert-success">{{ session('message') }}</p>
        @endif
      
        <div class="row centered-form justify-content-center">
            <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title text-center bg-info"
                            style="padding:5px;font-size:18px;font-weight:bold"><span class="fa fa-envelope "> </span>
                            Request for blood</h3>
                    </div>
                    <div class="panel-body">
                        <p id="errorBox"></p>

                        <form method="POST" action="{{ route('bloodreq-user-store') }}" class="mb-3"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label class="control-label text-primary">Patient Name</label>
                                <input type="text" placeholder="Patient Name" name="patient_name" required id="NAME"
                                    class="form-control input-sm">
                            </div>

                            <div class="form-group">
                                <label class="control-label text-primary" for="gender">Gender</label>
                                <select id="gen" name="gender" required class="form-control input-sm">
                                    <option>Select Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Others">Others</option>
                                </select>
                            </div>


                            <div class="form-group">
                                <label class="control-label text-primary">Required Blood Group</label>
                                <select name="blood_group" id="BLOOD" required class="form-control input-sm">
                                    <option>Select Blood</option>
                                    <option value="A+">A+</option>
                                    <option value="B+">B+</option>
                                    <option value="O+">O+</option>
                                    <option value="AB+">AB+</option>
                                    <option value="A-">A-</option>
                                    <option value="B-">B-</option>
                                    <option value="O-">O-</option>
                                    <option value="AB-">AB-</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="control-label text-primary">Need Unit Of Blood (bags)</label>
                                <input type="number" required name="blood_unit" id="BUNIT" class="form-control"
                                    placeholder="Insert No Of Unit">
                            </div>
                            <div class="form-group">
                                <label for="hosptName" class="control-label text-primary">Hospital Name</label>
                                <input type="text" class="form-control" name="hospital_name" id="hosptName"
                                    placeholder="Ex: Lab-8,Uttara" required>
                            </div>
                            <div class="form-group">
                                <x-utilities.form.address2/>
                            </div>

                            <div class="form-group">
                                <label class="control-label text-primary">When Required</label>
                                <input type="date" placeholder="DD/MM/YYYY" class="form-control input-sm DATES"
                                    name="require_date" id="RDATE" required>
                            </div>

                            <div class="form-group">
                                <label class="control-label text-primary" for="contact-name">Contact Name</label>
                                <input type="text" placeholder="Contact Name" class="form-control input-sm"
                                    name="contact_name" id="contact-name" required>
                            </div>

                            <div class="form-group">
                                <label class="control-label text-primary">Email ID</label>
                                <input type="email" placeholder="Contact Email" class="form-control input-sm"
                                    name="email" id="EMAIL" required>
                            </div>
                            <div class="form-group">
                                <label class="control-label text-primary">Contact No-1</label>
                                <input type="text" placeholder="Contact Number" class="form-control input-sm"
                                    name="phone" id="CON1" required>
                            </div>
                            <div class="form-group">
                                <label class="control-label text-primary">Contact No-2 (optinal)</label>
                                <input type="text" placeholder="Contact Number" class="form-control input-sm"
                                    name="phone2" id="CON2">
                            </div>
                            <div class="form-group">
                                <label class="control-label text-primary">Additional Information:</label>
                                <textarea required name="additional" id="CADDRESS" rows="5" style="resize:none;" class="form-control"
                                    placeholder="Additional info..." required></textarea>
                            </div>
                            <div class="form-group">
                                <label class="control-label text-primary">Reason For Blood</label>
                                <textarea required name="reason" id="REASON" rows="5" style="resize:none;" class="form-control"
                                    placeholder="Reason For Blood" id="REASON" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="formFile" class="control-label text-primary">Upload Any Authorised Blood
                                    requirement
                                    copy</label>
                                <input class="form-control mb-1" name="official_report" type="file" id="formFile">
                            </div>


                            <div class="form-group">
                                <button class="btn btn-primary w-100" id="BTN" name="submit"><i
                                        class="fa fa-send"></i>
                                    Request
                                    Now</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>


</x-frontend.layouts.master>
