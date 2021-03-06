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

<?php
/**  
 * class is used to create a form for Contactdetails along with the validation
*/
class Contactdetails_Form_contactdetails extends Zend_Form
{
    public function init() 
    {
	Zend_Dojo::enableForm($this);
    }

    public function __construct($id,$subId) 
    {

    	parent::__construct($id); //record id 
        parent::__construct($subId); //module id
        //create a contact details form elements
        $vtype=array('Digits');
	$formfield = new App_Form_Field ();
        $contactPerson = $formfield->field('Text','contact_person','','','mand','Contact person',true,'','','','','',1,0);
        $contactPerson->setAttrib('maxlength',30);
        $telephone = $formfield->field('Text','telephone','','','mand','Telephone number',true,$vtype,'','','','',1,0);
        $telephone->setAttrib('maxlength',12);
	$mobile = $formfield->field('Text','mobile','','','mand','mobile',true,$vtype,1,15,'','',1,0);
        $mobile->setAttrib('maxlength',10);

        $email = $formfield->field('Text','email','','','mand','Email',true,'','','','','',1,0);
        $email->addValidator('EmailAddress');
        $email->addErrorMessage('Enter valid email address');
        //hidden feilds
        $id = $formfield->field('Hidden','id','','','','',false,'','','','','',0,$id);
        $subId = $formfield->field('Hidden','submodule_id','','','','',false,'','','','','',0,$subId);

        $createdBy = $formfield->field('Hidden','created_by','','','','',false,'','','','','',0,1);
        $createdDate = $formfield->field('Hidden','created_date','','','','',false,'','','','','',0,date("y/m/d H:i:s"));
        $recordstatusId = $formfield->field('Hidden','recordstatus_id','','','','',false,'','','','','',0,3);

        $this->addElements(array($id,$contactPerson,$telephone,$mobile,$email,$subId,$createdBy,$createdDate));
    }
}
/** end of class */
