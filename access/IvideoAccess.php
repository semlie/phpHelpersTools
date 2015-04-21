<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author Admin
 */
interface IvideoAccess {
    //put your code here
function IsUser($userEmail);
function getAgeInLevels($userEmail,$level);
function IsUserInLevel($userEmail,$level);

}
