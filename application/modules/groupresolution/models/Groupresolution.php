<?php
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
class Groupresolution_Model_Groupresolution extends Zend_Db_Table {
    protected $_name = 'ourbank_member'; // set ourbank_member table is a base table

        // get group details 
	public function getgroup($id){ 
		$select=$this->select()
			->setIntegrityCheck(false)
			->join(array('a' => 'ourbank_group'),array('id'),array('id as groupid','village_id as officeid','name as groupname','group_created_date','groupcode', 'saving_perweek','penalty_latecoming','penalty_notcoming','rateinterest'))
                ->where('a.groupcode=?',$id)
			->join(array('b' => 'ourbank_office'),'b.id  = a.village_id',array('name as officename'))
			->joinLeft(array('c' => 'ourbank_address'),'c.id  = a.id',array('address1','address2','address3','city','district','state','zipcode'));
		//->join(array('d' => 'ourbank_groupmembers'),'d.group_id  = a.id',array('member_id'))
		//		->join(array('e' => 'ourbank_accounts'),'e.member_id  = d.member_id',array('e.account_number','e.product_id'));
// // 		die($select->__toString($select));
		$result=$this->fetchAll($select);
		return $result->toArray();
        } 

	public function getgroupaccount($id){ 
		$select=$this->select()
			->setIntegrityCheck(false)
			->join(array('a' => 'ourbank_group'),array('id'),array('id as groupid','village_id as officeid','name','group_created_date','groupcode', 'saving_perweek','penalty_latecoming','penalty_notcoming','rateinterest'))
                ->where('a.groupcode=?',$id)
->join(array('d' => 'ourbank_groupmembers'),'d.group_id  = a.id',array('member_id'))
			->join(array('e' => 'ourbank_accounts'),'e.member_id  = d.member_id',array('e.account_number','e.product_id'));
// // 		 die($select->__toString($select));

		$result=$this->fetchAll($select);
		return $result->toArray();
        } 


        // get group location geo location 
	public function getlocation($id){ 
		$select=$this->select()
			->setIntegrityCheck(false)
			->join(array('a' => 'ourbank_group'),array('id'),array('latitude','longitude'))	->where('a.id = '.$id);
		$result=$this->fetchAll($select);
		return $result->toArray();
        }
        // get group members 
        public function getgroupmembers($id)
        {
        $select=$this->select()
                ->setIntegrityCheck(false)
        	->join(array('a' => 'ourbank_group'),array('id'))
		->where('a.groupcode = '.$id)
		->join(array('b' => 'ourbank_groupmembers'),'b.group_id  = a.id')
		->join(array('c' => 'ourbank_familymember'),'b.member_id  = c.id',array('c.name as membername','family_id','village_id'))
		->joinLeft(array('d' => 'ourbank_agriculture'),'d.family_id  = c.family_id')
		->joinLeft(array('e' => 'ourbank_loanprocess'),'e.member_id  = c.family_id')
		->joinLeft(array('f' => 'ourbank_master_loanpurpose'),'e.purpose  = f.id',array('name as purposename'))
		->join(array('g' => 'ourbank_office'),'g.id  = c.village_id',array('name as bank') );
// 	die($select->__toString($select));

       $result=$this->fetchAll($select);
       return $result->toArray();
    }

     // get module description  details 
    public function getmodule($modulename)
   {
      $select=$this->select()
                   ->setIntegrityCheck(false)
                   ->join(array('ourbank_modules'),array('module_id'))
                   ->where('module_description=?',$modulename);
        $result=$this->fetchAll($select);
       return $result->toArray();
   }
}
