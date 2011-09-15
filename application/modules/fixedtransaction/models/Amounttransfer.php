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

class Transaction_Model_Amounttransfer extends Zend_Db_Table{
    protected $db;

    public function searchpersnolsavings($accountNo) 
    {
        $db = $this->getAdapter();
        $sql = "Select A.memberfirstname as name, 
                       D.offerproductname,    
                       B.membercode,
                       C.account_number,
                       E.office_name,
                       C.account_id
                       from 
                       ourbank_membername A,
                       ourbank_members B,
                       ourbank_accounts C,
                       ourbank_productsofferdetails D,
                       ourbank_officenames E
                    WHERE
                        (C.account_number = '$accountNo') AND
                        (C.accountstatus_id = '3' OR C.accountstatus_id = '1') AND
                        (C.product_id = D.offerproduct_id) AND
                        (D.recordstatus_id = '3' || D.recordstatus_id = '1') AND
                        (B.member_id = C.member_id) AND
                        (A.member_id = B.member_id) AND
                        (A.recordstatus_id = '3') AND
                        (B.member_status = '3' OR B.member_status = '1') AND
                        (E.office_id = B.memberbranch_id) AND
                        (E.recordstatus_id = '3' || E.recordstatus_id = '1') 

                    UNION
                Select A.groupname as name, 
                       D.offerproductname,    
                       B.membercode,
                       C.account_number,
                       E.office_name,
                       C.account_id
                       from 
                       ourbank_groupaddress A,
                       ourbank_members B,
                       ourbank_accounts C,
                       ourbank_productsofferdetails D,
                       ourbank_officenames E
                WHERE
                (C.account_number = '$accountNo') AND
                        (C.accountstatus_id = '3' OR C.accountstatus_id = '1') AND
                        (C.product_id = D.offerproduct_id) AND
                        (D.recordstatus_id = '3' || D.recordstatus_id = '1') AND
                        (B.member_id  = C.member_id) AND
                        (A.group_id  = B.member_id) AND
                        (A.recordstatus_id = '3') AND
                        (B.member_status = '3' OR B.member_status = '1') AND
                        (E.office_id = B.memberbranch_id) AND
                        (E.recordstatus_id = '3' || E.recordstatus_id = '1') ";

        $result = $db->fetchAll($sql);
        return $result;
    }
    
    public function balance($accountNo) 
    {
        $db = $this->getAdapter();
        $sql = "SELECT 
                (sum(amount_to_bank)-sum(amount_from_bank)) balance
                FROM 
                ourbank_transaction
                WHERE
                (account_id = '$accountNo') ";
        $result = $db->fetchAll($sql);
        return $result;
    }




    public function accidGlsubcode($accountNo) 
    {
        $db = $this->getAdapter();
        $sql = "SELECT 
                *
                FROM 
                ourbank_accounts A,
                ourbank_productsofferdetails B,
                ourbank_productdetails C,
                ourbank_members D
                WHERE
                (A.account_number = '$accountNo') AND
                A.product_id = B.offerproduct_id AND
                C.product_id = B.product_id AND
                A.member_id = D.member_id";

        $result = $db->fetchAll($sql);
        return $result;
    }
   
}
