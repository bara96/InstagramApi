<?php namespace ProcessWire;

/**
 * Configuration helper class for Instagram module
 *
 * CONFIG PROPERTIES (mirrored from Instagram module)
 */

class InstagramConfigure extends Wire {
    protected array $permissions = array(
        'user_profile',
        'user_media',
    );

	protected InstagramApi $module;

    /**
     * PaypalConfigure constructor.
     * @param InstagramApi $module
     */
    public function __construct(InstagramApi $module) {
        $module->wire($this);
        $this->module = $module;
	}

    /**
     * @param object|string $key
     * @return mixed|null
     */
    public function get($key) {
		return $this->module->get($key);
	}

    /**
     * @param InputfieldWrapper $inputfields
     * @return InputfieldWrapper
     * @throws WireException
     * @throws WirePermissionException
     */
    public function getInputfields(InputfieldWrapper $inputfields): InputfieldWrapper
    {
		$modules = $this->wire('modules');
        $module = $this->module;

        //Setting up credentials
        /** @var InputfieldFieldset $field */
        $fieldset = $modules->get('InputfieldFieldset');
        $fieldset->label = _('Setting up credentials');
        $fieldset->description("You can get Instagram App ID and Instagram App Secret by creating an app on [Facebook Developer](https://developers.facebook.com/) and adding and Instagram App on 'Products' section");
        $fieldset->icon = 'key';
        if(!empty($module->clientId) && !empty($module->clientSecret)) $fieldset->collapsed = Inputfield::collapsedYes;
        $inputfields->add($fieldset);

        /** @var InputfieldText $field */
        $field = $modules->get("InputfieldText");
        $field->attr('name', 'clientId');
        if(!empty( $module->clientId)) $field->attr('value', $module->clientId);
        $field->label = __("Set the Instagram App ID");
        $field->required = 1;
        $fieldset->add($field);

        /** @var InputfieldText $field */
        $field = $modules->get("InputfieldText");
        $field->attr('name', 'clientSecret');
        if(!empty( $module->clientSecret)) $field->attr('value', $module->clientSecret);
        $field->label = __("Set the Instagram App Secret");
        $field->required = 1;
        $fieldset->add($field);

        //Setting up defaults
        /** @var InputfieldFieldset $field */
        $fieldset = $modules->get('InputfieldFieldset');
        $fieldset->label = _('Settings');
        $inputfields->add($fieldset);

        $f = $modules->get('InputfieldAsmSelect');
        $f->attr('name', 'scopes');
        $f->label = $this->_('Permissions to request from the app user.');
        $f->description = sprintf($this->_('A list of available scopes can be found [here](%s).'),
            'https://developers.facebook.com/docs/instagram-basic-display-api/overview#permissions');
        $f->notes = $this->_("user_profile is required.");
        foreach($this->permissions as $name) {
            $f->addOption($name);
        }
        $f->attr('value', $module->scopes);
        $fieldset->add($f);
        $f->required = 1;

        return $inputfields;
	}
}
