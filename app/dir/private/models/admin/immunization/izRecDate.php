<?php
// IZ Date Recommendation
if(isset($_GET['patientID'])){
    // Patient's Date of Birth
    $decrypted_dob = htmlspecialchars(decryptthis($diversity['dob'], $key));
    $dob = (date('m', strtotime($decrypted_dob)) . '/' . date('d', strtotime($decrypted_dob)) . '/' . date('Y', strtotime($decrypted_dob)));
    $dob = date('m/d/Y',strtotime($dob));
    $date = date('Y-m-d'); // Today's date (For some reason, this is the only format that works with $dob when identifying overdue IZ)
    $today = date('Y') . '-' . date('m') . '-' . date('d');

    $year = htmlspecialchars((date('Y') - date('Y', strtotime($decrypted_dob))));
    $month = ($year / 0.1);

    if($year <= 1){
        $age = htmlspecialchars("$year year old");
    }
    else{
        $age = htmlspecialchars("$year years old");
    }

    // Date from Today
    $month1 = strtotime("+1 months", strtotime($date));
    $month1 = date('m/d/Y',$month1);
    $month2 = strtotime("+2 months", strtotime($date));
    $month2 = date('m/d/Y',$month2);
    $month4 = strtotime("+4 months", strtotime($date));
    $month4 = date('m/d/Y',$month4);
    $month6 = strtotime("+6 months", strtotime($date));
    $month6 = date('m/d/Y',$month6);
    $month9 = strtotime("+9 months", strtotime($date));
    $month9 = date('m/d/Y',$month9);
    $month12 = strtotime("+12 months", strtotime($date));
    $month12 = date('m/d/Y',$month12);
    $month15 = strtotime("+15 months", strtotime($date));
    $month15 = date('m/d/Y',$month15);
    $month18 = strtotime("+18 months", strtotime($date));
    $month18 = date('m/d/Y',$month18);
    $year4 = strtotime("+54 months", strtotime($date));
    $year4 = date('m/d/Y',$year4);
  
    // Date from date of birth
    $month1old = strtotime("+1 months", strtotime($dob));
    $month1old = date('m/d/Y',$month1old);
    $month1old_ = strtotime("+1 months", strtotime($dob));
    $month1old_ = date('Y-m-d',$month1old_);
    $month2old = strtotime("+2 months", strtotime($dob));
    $month2old = date('m/d/Y',$month2old);
    $month2old_ = strtotime("+2 months", strtotime($dob));
    $month2old_ = date('Y-m-d',$month2old_);
    $month4old = strtotime("+4 months", strtotime($dob));
    $month4old = date('m/d/Y',$month4old);
    $month6old = strtotime("+6 months", strtotime($dob));
    $month6old = date('m/d/Y',$month6old);
    $month11old = strtotime("+11 months", strtotime($dob));
    $month11old = date('m/d/Y',$month11old);
    $month12old = strtotime("+12 months", strtotime($dob));
    $month12old = date('m/d/Y',$month12old);
    $month12old_ = strtotime("+12 months", strtotime($dob));
    $month12old_ = date('Y-m-d',$month12old_);
    $month15old = strtotime("+15 months", strtotime($dob));
    $month15old = date('m/d/Y',$month15old);
    $month17old = strtotime("+18 months", strtotime($dob));
    $month17old = date('m/d/Y',$month17old);
    $month18old = strtotime("+18 months", strtotime($dob));
    $month18old = date('m/d/Y',$month18old);
    $year4old = strtotime("+4 years", strtotime($dob));
    $year4old = date('m/d/Y',$year4old);
    $year6old = strtotime("+6 years", strtotime($dob));
    $year6old = date('m/d/Y',$year6old);
    $year11old = strtotime("+11 years", strtotime($dob));
    $year11old = date('m/d/Y',$year11old);
    $year11old_ = strtotime("+11 years", strtotime($dob));
    $year11old_ = date('Y-m-d',$year11old_);
    $year11_6month_old = strtotime("+138 months", strtotime($dob));
    $year11_6month_old = date('m/d/Y',$year11_6month_old);
    $year14old_ = strtotime("+14 years", strtotime($dob));
    $year14old_ = date('Y-m-d',$year14old_);
    $year15old = strtotime("+15 years", strtotime($dob));
    $year15old = date('m/d/Y',$year15old);
    $year15old_ = strtotime("+15 years", strtotime($dob));
    $year15old_ = date('Y-m-d',$year15old_);
    $year15years_2months = strtotime("+182 months", strtotime($dob));
    $year15years_2months = date('m/d/Y',$year15years_2months);
    $year15years_2months_ = strtotime("+182 months", strtotime($dob));
    $year15years_2months_ = date('Y-m-d',$year15years_2months_);
    $year15years_6months = strtotime("+186 months", strtotime($dob));
    $year15years_6months = date('m/d/Y',$year15years_6months);
    $year15years_6months_ = strtotime("+186 months", strtotime($dob));
    $year15years_6months_ = date('Y-m-d',$year15years_6months_);
    $year16old = strtotime("+16 years", strtotime($dob));
    $year16old = date('m/d/Y',$year16old);
    $year16_1month_old = strtotime("+193 months", strtotime($dob));
    $year16_1month_old = date('m/d/Y',$year16_1month_old);
    $year18old = strtotime("+18 years", strtotime($dob));
    $year18old = date('m/d/Y',$year18old);
    $year18old_ = strtotime("+18 years", strtotime($dob));
    $year18old_ = date('Y-m-d',$year18old_);
}
else{
    exit(0);
} 
?>