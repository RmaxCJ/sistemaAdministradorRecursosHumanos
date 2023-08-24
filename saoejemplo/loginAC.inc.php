<?php
Class LoginAD
{

	public function autentica($user, $password)
	{
		// Active Directory server
		$ldap_host = "gporotoplas.net";
	
		// Active Directory DN
		$ldap_dn = "OU=Cuentas Servicios, DC=gporotoplas, DC=net";
	
		// Domain, for purposes of constructing $user
		$ldap_usr_dom = '@gporotoplas.net';
	
		// connect to active directory
		$ldap = ldap_connect($ldap_host)
		or die("Could not conenct to $ldap_host");
	
		// verify user and password
		if($bind = ldap_bind($ldap, $user.$ldap_usr_dom, $password)) 
			$valido = 1;
		else 
			$valido = 0;
		
		return $valido;
	}
}
?>