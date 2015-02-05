<?php

class SRH_User_Caps {

	/**
	 * An array of all protected roles
	 * @var array
	 */
	protected $protectedRoles = array(
		'srh_framework_wp_developer_role',
	);

	/**
	 * Add the necessary filters for filtering out editable roles and mapping meta caps.
	 */
	function __construct() {
		add_filter( 'editable_roles', array( $this, 'editable_roles' ), 20 );
		add_filter( 'map_meta_cap', array( $this, 'map_meta_cap' ), 10, 4 );
	}

	/**
	 * Remove our protected roles from the list of editable roles if the current user doesn't have one of them.
	 *
	 * @param array $roles The list of editable roles. This is an associative array using the role slug as keys and the display names as values.
	 * @return array The filtered list of roles
	 */
	function editable_roles( $roles ) {
		$userInProtectedRole = false;
		foreach( $this->protectedRoles as $k => $role ) {
			if( !isset( $roles[$role] ) ) {
				unset( $this->protectedRoles[$k] );
				continue;
			}
			if( !current_user_can( $role ) )
				continue;
			$userInProtectedRole = true;
			break;
		}
		$roles = array_diff_key( $roles, array_flip( $this->protectedRoles ) );
		return $roles;
	}

	/**
	 * If someone is trying to edit or delete a protected role and that user isn't in a protected role, don't allow it.
	 *
	 * For our purposes, $args[0] should be the ID of the user having something done to them (the user about to be
	 * edited, deleted, promoted, etc.)
	 *
	 * @param array $caps The current list of required capabilities for this action
	 * @param string $cap The capability we're checking (i.e., the one used in current_user_can() )
	 * @param int $user_id The ID of the user for whom we're checking capabilities
	 * @param array $args Any extra arguments
	 * @return array The final array of capabilities required for this action
	 */
	function map_meta_cap( $caps, $cap, $user_id, $args ) {

		switch( $cap ) {
			case 'edit_user':
			case 'remove_user':
			case 'promote_user':
				if( isset( $args[0] ) && $args[0] == $user_id )
					break;
				elseif( !isset( $args[0] ) )
					$caps[] = 'do_not_allow';
				$other = new WP_User( absint( $args[0] ) );
				$otherHasCap = $userHasCap = false;
				foreach( $this->protectedRoles as $role ) {
					$otherHasCap = $otherHasCap ? true : $other->has_cap( $role );
					$userHasCap = $userHasCap ? true : current_user_can( $role );
				}
				if( $otherHasCap && !$userHasCap ) {
					$caps[] = 'do_not_allow';
				}
				break;
			case 'delete_user':
			case 'delete_users':
				if( !isset( $args[0] ) )
					break;
				$other = new WP_User( absint( $args[0] ) );
				$otherHasCap = $userHasCap = false;
				foreach( $this->protectedRoles as $role ) {
					$otherHasCap = $otherHasCap ? true : $other->has_cap( $role );
					$userHasCap = $userHasCap ? true : current_user_can( $role );
				}
				if( $otherHasCap && !$userHasCap ) {
					$caps[] = 'do_not_allow';
				}
				break;
			default:
				break;
		}
		return $caps;
	}

}

new SRH_User_Caps();
