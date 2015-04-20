;<?php die() ?>
; SVN FILE: $Id$
;/**
; * Short description for file.
; *
; *
; * PHP versions 4 and 5
; *
; * CakePHP(tm) :  Rapid Development Framework http://cakephp.org
; * Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
; *
; *  Licensed under The MIT License
; *  Redistributions of files must retain the above copyright notice.
; *
; * @copyright     Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
; * @link          http://cakephp.org CakePHP(tm) Project
; * @package       cake
; * @subpackage    cake.app.config
; * @since         CakePHP(tm) v 0.10.0.1076
; * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
; */

; acl.ini.php - Cake ACL Configuration
; ---------------------------------------------------------------------
; Use this file to specify personnel permissions.
; aco = access control object (something in your application)
; aro = access request object (something requesting access)
;
; Personnel records are added as follows:
;
; [uid]
; groups = group1, group2, group3
; allow = aco1, aco2, aco3
; deny = aco4, aco5, aco6
;
; Group records are added in a similar manner:
;
; [gid]
; allow = aco1, aco2, aco3
; deny = aco4, aco5, aco6
;
; The allow, deny, and groups sections are all optional.
; NOTE: groups names *cannot* ever be the same as users!
;
; ACL permissions are checked in the following order:
; 1. Check for personnel denies (and DENY if specified)
; 2. Check for personnel allows (and ALLOW if specified)
; 3. Gather personnel's groups
; 4. Check group denies (and DENY if specified)
; 5. Check group allows (and ALLOW if specified)
; 6. If no aro, aco, or group information is found, DENY
;
; ---------------------------------------------------------------------

;-------------------------------------
;Personnels
;-------------------------------------

[user-goes-here]
groups = group1, group2
deny = aco1, aco2
allow = aco3, aco4

;-------------------------------------
;Groups
;-------------------------------------

[groupname-goes-here]
deny = aco5, aco6
allow = aco7, aco8