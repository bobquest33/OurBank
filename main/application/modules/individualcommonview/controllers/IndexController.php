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
class Individualcommonview_IndexController extends Zend_Controller_Action
{
    public function init() 
    {
  	$this->view->pageTitle='Individual member';
        $globalsession = new App_Model_Users();
        $this->view->globalvalue = $globalsession->getSession();
	$this->view->createdby = $this->view->globalvalue[0]['id'];
// 	$this->view->username = $this->view->globalvalue[0]['username'];
//         if (($this->view->globalvalue[0]['id'] == 0)) {
//              $this->_redirect('index/logout');
//         }
	$this->view->adm = new App_Model_Adm();    
    }

    public function indexAction() 
    {
    }

    public function commonviewAction()
    {
        //Acl
        //$access = new App_Model_Access();
        //$checkaccess = $access->accessRights('Individual',$this->view->globalvalue[0]['name'],'commonviewAction');
        //if (($checkaccess != NULL)) {

        $id=$this->_request->getParam('id');
        $this->view->memberid=$id;
        $individualcommon=new Individualcommonview_Model_individualcommon;
        $member_name=$individualcommon->getmember($id);
//getting module id and submodule id
        $module=$individualcommon->getmodule('Individual');
        foreach($module as $module_id){ }
        $this->view->mod_id=$module_id['parent'];
        $this->view->sub_id=$module_id['module_id'];
//getting member details, address, contact details
        $this->view->membername=$member_name;
        $this->view->address = $this->view->adm->getModule("address",$id,"Individual");
        $this->view->family=$edit_family = $this->view->adm->editRecord("ob_member_family",$id);
        $this->view->contact = $this->view->adm->getModule("contact",$id,"Individual");
        //}
        //else {
        //$this->_redirect('index/index');
        //}
    }
}