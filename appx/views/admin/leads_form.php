<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lead Form</title>
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
      integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q="
      crossorigin="anonymous"
    />
    <!--end::Fonts-->
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/styles/overlayscrollbars.min.css"
      integrity="sha256-tZHrRjVqNSRyWg2wbppGnT833E/Ys0DHWGwT04GiqQg="
      crossorigin="anonymous"
    />
    <!--end::Third Party Plugin(OverlayScrollbars)-->
    <!--begin::Third Party Plugin(Bootstrap Icons)-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
      integrity="sha256-9kPW/n5nn53j4WMRYAxe9c1rCY96Oogo/MKSVdKzPmI="
      crossorigin="anonymous"
    />
    <!--end::Third Party Plugin(Bootstrap Icons)-->
    <!--begin::Required Plugin(AdminLTE)-->
    <link rel="stylesheet" href="<?php echo base_url(); ?>dist/css/adminlte.css" />
    <!--end::Required Plugin(AdminLTE)-->
    <!-- apexcharts -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.css"
      integrity="sha256-4MX+61mt9NVvvuPjUWdUdyfZfxSB1/Rf9WtqRHgG5S0="
      crossorigin="anonymous"
    />
</head>
<body>
<!--begin::Form Validation-->
<div class="card card-info card-outline mb-4">
  <!--begin::Header-->
  <div class="card-header" style="display: flex; justify-content: center; align-items: center;"><div class="card-title" style="font-weight:bold;">Student Details Form</div></div>
  <!--end::Header-->
  <!--begin::Form-->
  <form class="needs-validation" action="<?= site_url('leads/add_new_lead') ?>" method="POST" novalidate>
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
              <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
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
                <option value="<?php echo $institute['id']; ?>"><?php echo $institute['company']; ?></option>
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
                    <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                    <?php } ?>
            </select>
            <div class="invalid-feedback">Please select a valid course.</div>
            <div class="valid-feedback">Looks good!</div>
        </div>
        <!--end::Col-->
                <!--begin::Col-->
                <div class="col-md-6">
                  <label for="validationCustom03" class="form-label">Notes (Optional)</label>
                    <input
                    type="text"
                    class="form-control"
                    id="student_notes"
                    name="student_notes"
                    />
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
<!--end::Form Validation-->
  </body>
</html>