<?php
/*
############################################################################
#  This file is part of OurBank.
############################################################################
#  OurBank is free software: you can redistribute it and/or modify
#  it under the terms of the GNU Affero General Public License as
#  published by the Free Software Foundation, either version 3 of the
#  License, or (at your option) any later version.
############################################################################
#  This program is distributed in the hope that it will be useful,
#  but WITHOUT ANY WARRANTY; without even the implied warranty of
#  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
#  GNU Affero General Public License for more details.
############################################################################
#  You should have received a copy of the GNU Affero General Public License
#  along with this program.  If not, see <http://www.gnu.org/licenses/>.
############################################################################
*/
?>

<?php class Form_Form_Fee extends Zend_Form {


		
	

	public function init() 
	{

		$vtype=array('Alpha','StringLength');
		$formfield = new App_Form_Field ();

		// 	$fieldtype,$fieldname,$table,$columnname,$cssname,$labelname,$required,$validationtype,$min,$max,$rows,$cols,$decorator,$value

                $name = $formfield->field('Text','name','','','mand','First name :',false,'','','','','',1,0);
                $lastname = $formfield->field('Text','lastname','','','mand','Last name :',false,'','','','','',1,0);
                $age = $formfield->field('Text','age','','','mand','Age :',true,'','','','','',1,0);
                $accountnumber = $formfield->field('Text','accountnumber','','','mand','Bank Account No :',true,'','','','','',1,0);
                $address1 = $formfield->field('Text','address1','','','mand','Address 1 :',false,'','','','','',1,0);
                $address2 = $formfield->field('Text','address2','','','mand','Address 2 :',false,'','','','','',1,0);
                $city = $formfield->field('Text','city','','','mand','City :',true,'','','','','',1,0);
                $state = $formfield->field('Text','state','','','mand','State :',true,'','','','','',1,0);
                $pin = $formfield->field('Text','pin','','','mand','Pin:',true,'','','','','',1,0);
                $fullname = $formfield->field('Text','fullname','','','mand','Fullname :',false,'','','','','',0,0);
                $relationship = $formfield->field('Text','relationship','','','mand','Relationship with nominee',false,'','','','','',0,0);
                $agelast = $formfield->field('Text','agelast','','','mand','Relationship with nominee',false,'','','','','',0,0);

                $option = $formfield->field('Text','option','','','mand','Option',false,'','','','','',0,0);
                 $option->setAttrib('size',12);
                $sumamount = $formfield->field('Text','sumamount','','','mand','Sum amount',false,'','','','','',0,0);
                 $sumamount->setAttrib('size',12);
                $basepremium = $formfield->field('Text','basepremium','','','mand','Basepremium',false,'','','','','',0,0);
                 $basepremium->setAttrib('size',12);
                $service = $formfield->field('Text','service','','','mand','Service',false,'','','','','',0,0);
                 $service->setAttrib('size',12);
                $total = $formfield->field('Text','total','','','mand','Total',false,'','','','','',0,0);
                 $total->setAttrib('size',12);

        // Hidden Feilds 
        $id = $formfield->field('Hidden','id','','','','',false,'','','','','',0,0);

					
            $this->addElements(array($id,$name,$accountnumber,$age,$lastname,$address1,$address2,$city,$state,$pin,$fullname,$relationship,$agelast,
                                    $option,$sumamount,$basepremium,$service,$total));
    }
}