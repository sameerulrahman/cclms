<!--begin::Form Validation-->
<div class="card card-info card-outline mb-4">
  <!--begin::Header-->
  <div class="card-header" style="display: flex; justify-content: center; align-items: center;"><div class="card-title" style="font-weight:bold;">Edit Student Details</div></div>
  <!--end::Header-->
  <!--begin::Form-->
  <form class="needs-validation" action="<?= site_url('leads/update_lead/' . $lead->id) ?>" method="POST" novalidate>
  <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" 
  value="<?= $this->security->get_csrf_hash(); ?>" />
    <!--begin::Body-->
    <div class="card-body">
      <!--begin::Row-->
      <div class="row g-3">
        <!--begin::Col-->
        <div class="col-md-6">
          <label for="validationCustom01" class="form-label">Name</label>
          <div class="input-group has-validation">
              <input
                type="text"
                class="form-control"
                id="name"
                name="name"
                value="<?php if(!empty($lead->name)){echo $lead->name;} ?>"
                required
              />
              <div class="invalid-feedback">Please provide a valid name.</div>
            <div class="valid-feedback">Looks good!</div>
          </div>
        </div>
        <!--end::Col-->
        <!--begin::Col-->
        <div class="col-md-6">
          <label for="validationCustom02" class="form-label">Address</label>
          <div class="input-group has-validation">
            <input
              type="text"
              class="form-control"
              id="address"
              name="address"
              value="<?php if(!empty($lead->address)){echo $lead->address;} ?>"
              required
            />
            <div class="invalid-feedback">Please provide a valid address.</div>
            <div class="valid-feedback">Looks good!</div>
          </div>
        </div>
        <!--end::Col-->
        <!--begin::Col-->
        <div class="col-md-6">
          <label for="validationCustomUsername" class="form-label">Phone Number</label>
          <div class="input-group has-validation">
            <input
            type="number"
            class="form-control"
            id="phone_number"
            name="phone_number"
            value="<?php if(!empty($lead->phone_number)){echo $lead->phone_number;} ?>"
            required
            />
            <div class="invalid-feedback">Please provide your contact number.</div>
            <div class="valid-feedback">Looks good!</div>
          </div>
        </div>
        <!--end::Col-->
        <!--begin::Col-->
        <div class="col-md-6">
          <label for="validationCustom03" class="form-label">School/College</label>
          <div class="input-group has-validation">
              <input
              type="text"
              class="form-control"
              id="school"
              name="school"
              value="<?php if(!empty($lead->school)){echo $lead->school;} ?>"
              required
              />
              <div class="invalid-feedback">Please provide your school/college/university name.</div>
              <div class="valid-feedback">Looks good!</div>
            </div>
        </div>
        <!--end::Col-->
        <!--begin::Col-->
        <div class="col-md-6">
          <label for="validationCustom04" class="form-label">Class</label>
          <select class="form-select" id="class" name="class" required>
            <option selected disabled value="">Choose...</option>
            <?php foreach($classes as $key=>$value){ ?>
                <option value="<?= $key ?>" <?= (isset($lead->class) && $lead->class == $key) ? 'selected' : '' ?>>
                    <?= $value ?>
                </option>
            <?php } ?>
            </select>
            <div class="invalid-feedback">Please select a valid class.</div>
            <div class="valid-feedback">Looks good!</div>
        </div>
        <!--end::Col-->
        <!--begin::Col-->
        <div class="col-md-6">
          <label for="validationCustom05" class="form-label">Preferred Institute</label>
          <select class="form-select" id="preferred_institute" name="preferred_institute" required>
            <option selected disabled value="">Choose...</option>
            <?php foreach($institutes as $institute){ ?>
                <option value="<?= $institute['id'] ?>" <?= (!empty($lead->preferred_institute) && $lead->preferred_institute == $institute['id']) ? 'selected' : '' ?>>
                    <?= $institute['company'] ?>
                </option>
            <?php } ?>
            </select>
            <div class="invalid-feedback">Please select a valid institute.</div>
            <div class="valid-feedback">Looks good!</div>
        </div>
        <!--end::Col-->
        <!--begin::Col-->
        <div class="col-md-6">
          <label for="validationCustom05" class="form-label">Preferred Course</label>
          <select class="form-select" id="preferred_course" name="preferred_course" required>
            <option selected disabled value="">Choose...</option>
                <?php foreach($courses as $key=>$value){ ?>
                    <option value="<?= $key ?>" <?= (isset($lead->preferred_course) && $lead->preferred_course == $key) ? 'selected' : '' ?>>
                        <?= $value ?>
                    </option>
                <?php } ?>
            </select>
            <div class="invalid-feedback">Please select a valid course.</div>
            <div class="valid-feedback">Looks good!</div>
        </div>
        <!--end::Col-->
                <!--begin::Col-->
                <div class="col-md-6">
                <label for="validationCustom05" class="form-label">Status</label>
          <select class="form-select" id="status" name="status" required>
            <option selected disabled value="">Choose...</option>
                <?php foreach($statuses as $key=>$value){ ?>
                    <option value="<?= $key ?>" <?= (isset($lead->status) && $lead->status == $key) ? 'selected' : '' ?>>
                        <?= $value ?>
                    </option>
                <?php } ?>
            </select>
            <div class="invalid-feedback">Please select a valid status.</div>
            <div class="valid-feedback">Looks good!</div>
                  </div>
                </div>
                <!--end::Col-->
      </div>
      <!--end::Row-->
</div>
    <!--end::Body-->
    <!--begin::Footer-->
    <div class="card-footer" style="display: flex; justify-content: center; align-items: center;">
      <button class="btn btn-info" type="submit">Submit form</button>
    </div>
    <!--end::Footer-->
  </form>
  <!--end::Form-->
  <!--begin::JavaScript-->
  <script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (() => {
  'use strict';

  const forms = document.querySelectorAll('.needs-validation');

  Array.from(forms).forEach((form) => {
    form.addEventListener('submit', (event) => {
      if (!form.checkValidity()) {
        event.preventDefault();
        event.stopPropagation();
        console.log("Form has validation errors.");
      } else {
        console.log("Submitting...");
      }

      form.classList.add('was-validated');
    }, false);
  });
})();

  </script>
  <!--end::JavaScript-->
</div>