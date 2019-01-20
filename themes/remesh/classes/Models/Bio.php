<?php

namespace Remesh\Models;

use Stem\Models\Attachment;
use Stem\Models\Post;
use Stem\Models\Utilities\CustomPostTypeBuilder;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Bio extends Post {
	protected $jobTitle = null;
	protected $image = null;
	protected $visible = true;

	//region Custom Post Type Setup

	protected static $postType = 'bio';

	/**
	 * @return array|null
	 * @throws \StoutLogic\AcfBuilder\FieldNameCollisionException
	 */
	public static function registerFields() {
		$builder = new FieldsBuilder(static::$postType);
		$builder
			->addText('job_title')
			->addTrueFalse('visible', ['default_value' => true]);

		return $builder->build();
	}

	public static function postTypeProperties() {
		$builder = new CustomPostTypeBuilder(static::$postType, 'Bio', 'Bios', static::$postType);
		return $builder
			->showInRest(false)
			->featuredImageName('Headshot')
			->supportsTitle(true)
			->supportsEditor(false)
			->supportsThumbnail(true)
			->excludeFromSearch(true)
			->publicQueryable(false)
			->menuIcon('dashicons-welcome-write-blog')
			->hasArchive(false)
			->addAdminFeaturedImage('cool', '')
			->addAdminMetaColumn('job_title', 'job_title', 'Title')
			->addAdminMetaColumn('visible', 'visible', 'Visible');
	}

	//endregion

	//region Properties

	/**
	 * @return Attachment|null
	 * @throws \Samrap\Acf\Exceptions\BuilderException
	 */
	public function image() {
		return $this->getACFProperty('image');
	}

	/**
	 * @return string|null
	 * @throws \Samrap\Acf\Exceptions\BuilderException
	 */
	public function name() {
		return $this->getACFProperty('name');
	}

	/**
	 * @return string|null
	 * @throws \Samrap\Acf\Exceptions\BuilderException
	 */
	public function jobTitle() {
		return $this->getACFProperty('jobTitle', 'job_title');
	}

	/**
	 * @return boolean
	 * @throws \Samrap\Acf\Exceptions\BuilderException
	 */
	public function visible() {
		return $this->getACFProperty('visible');
	}

	//endregion
}