<div class="tab-pane fade" id="nav-adolescent" role="tabpanel" aria-labelledby="nav-adolescent-tab" tabindex="0">
  <table class="focus-ring table table-sm text-nowrap table-bordered mt-3">
    <thead align="center">
      <tr>
        <th><a title="Immunization History" href="#" class="" style="text-decoration:none;color:black" data-bs-toggle="modal" data-bs-target="#administer-Modal"><i class="bi bi-card-list"></i></a></th>
        <th><small>7-8 Years</small></th>
        <th><small>9-10 Years</small></th>
        <th><small>11-12 Years</small></th>
        <th><small>13-14 Years</small></th>
        <th><small>15 Years</small></th>
        <th><small>16 Years</small></th>
        <th><small>17-18 Years</small></th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th><small><a href="#" data-bs-toggle="popover" data-bs-trigger="focus" data-bs-placement="top" data-bs-content="Number of doses recommended depends on your child's age and type of COVID-19 vaccine used." style="text-decoration:none;color:black">
            COVID-19**
          </a></small>
        </th>
        <td colspan="12" align="center"><button class="focus-ring btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#covid-Modal" style="color:#0C88A9;width:70rem; border-radius:16px">COVID-19**</button></td>
      </tr>
      <tr>
        <th><small><a href="#" data-bs-toggle="popover" data-bs-trigger="focus" data-bs-placement="top" data-bs-content="Two doses given at least 4 weeks apart are recommended for children age 6 months through 8 years of age who are getting an influenza (flu) vaccine for the first time and some other children in this age group." style="text-decoration:none;color:black">
            Influenza*
          </a></small>
        </th>
        <td colspan="12" align="center"><button class="focus-ring btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#flu-Modal" style="color:#137A5B;width:70rem; border-radius:16px">Influenza (One or Two Doses Yearly)*</button></td>
      </tr>
      <tr>
        <th><small><a href="#" data-bs-toggle="popover" data-bs-trigger="focus" data-bs-placement="top" data-bs-content="Tetanus, diphtheria, acellular pertussis (Tdap ≥7 yrs)" style="text-decoration:none;color:black">
            Tdap
          </a></small>
        </th>
        <td></td>
        <td></td>
        <td colspan="1" align="center"><button class="focus-ring btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#tdap-Modal" style="color:#059D00;width:5rem; border-radius:16px">TDaP</button></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      <tr>
        <th><small><a href="#" data-bs-toggle="popover" data-bs-trigger="focus" data-bs-placement="top" data-bs-content="Tetanus, diphtheria, acellular pertussis (Tdap ≥7 yrs)" style="text-decoration:none;color:black">
            Meningococcal
          </a></small>
        </th>
        <td></td>
        <td></td>
        <td colspan="1" align="center"><button class="focus-ring btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#mcv-1st-Modal" style="color:#C0A900;width:5rem; border-radius:16px">MCV</button></td>
        <td></td>
        <td></td>
        <td colspan="1" align="center"><button class="focus-ring btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#mcv-2nd-Modal" style="color:#C0A900;width:5rem; border-radius:16px">MCV</button></td>
        <td></td>
      </tr>
      <tr>
        <th><small><a href="https://eziz.org/assets/docs/IMM-1254.pdf" target="_blank" data-bs-toggle="popover" data-bs-trigger="focus" data-bs-placement="top" data-bs-content="Administer 2 doses if starting at 9-14 Years. Vaccination is routinely recommended at ages 11-12 years and can start at age 9. Minimum acceptable interval is 5 months." style="text-decoration:none;color:black">
            HPV**
          </a></small>
        </th>
        <td></td>
        <td colspan="2" align="center"><button class="focus-ring btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#hpv-Modal" style="color:#FF8B00;width:13rem; border-radius:16px">HPV**</button></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      <tr>
        <th><small><a href="https://eziz.org/assets/docs/IMM-1254.pdf" target="_blank" data-bs-toggle="popover" data-bs-trigger="focus" data-bs-placement="top" data-bs-content="Administer 3 doses if starting at 15-45 Years or with compromised immune system at any age. 2nd dose must be administered within 1-2 months and 3rd dose must be administered within 1-4 months (6 months between 1st and 3rd dose)." style="text-decoration:none;color:black">
            HPV***
          </a></small>
        </th>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td colspan="3" align="center"><button class="focus-ring btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#hpv-Modal" style="color:#E08406;width:35rem; border-radius:16px">HPV***</button></td>
      </tr>
    </tbody>
  </table>
</div>

<!-- Modal -->
<?php include('../modal/iz-history.php'); ?>
<?php include('../modal/administer-tdap.php'); ?>
<?php include('../modal/administer-mcv-1st.php'); ?>
<?php include('../modal/administer-mcv-2nd.php'); ?>
<?php include('../modal/administer-hpv.php'); ?>
