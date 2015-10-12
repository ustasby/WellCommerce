<?php
/*
 * WellCommerce Open-Source E-Commerce Platform
 *
 * This file is part of the WellCommerce package.
 *
 * (c) Adam Piotrowski <adam@wellcommerce.org>
 *
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed with this source code.
 */
namespace WellCommerce\Bundle\OrderBundle\Form;

use WellCommerce\Bundle\CoreBundle\Form\AbstractFormBuilder;
use WellCommerce\Bundle\DataSetBundle\CollectionBuilder\SelectBuilder;
use WellCommerce\Bundle\FormBundle\Elements\FormInterface;

/**
 * Class OrderStatusFormBuilder
 *
 * @author Adam Piotrowski <adam@wellcommerce.org>
 */
class OrderStatusFormBuilder extends AbstractFormBuilder
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormInterface $form)
    {
        $requiredData = $form->addChild($this->getElement('nested_fieldset', [
            'name'  => 'required_data',
            'label' => $this->trans('form.fieldset.required_data')
        ]));

        $requiredData->addChild($this->getElement('checkbox', [
            'name'    => 'enabled',
            'label'   => $this->trans('order_status.label.enabled'),
            'comment' => $this->trans('order_status.comment.enabled'),
            'default' => 1
        ]));

        $orderStatusGroupSelectBuilder = new SelectBuilder($this->get('order_status_group.dataset'));
        $orderStatusGroups             = $orderStatusGroupSelectBuilder->getItems();

        $requiredData->addChild($this->getElement('select', [
            'name'        => 'orderStatusGroup',
            'label'       => $this->trans('order_status.label.order_status_group'),
            'options'     => $orderStatusGroups,
            'default'     => current(array_keys($orderStatusGroups)),
            'transformer' => $this->getRepositoryTransformer('entity', $this->get('order_status_group.repository'))
        ]));

        $languageData = $requiredData->addChild($this->getElement('language_fieldset', [
            'name'        => 'translations',
            'label'       => $this->trans('fieldset.translations.label'),
            'transformer' => $this->getRepositoryTransformer('translation', $this->get('order_status.repository'))
        ]));

        $languageData->addChild($this->getElement('text_field', [
            'name'  => 'name',
            'label' => $this->trans('order_status.label.name'),
        ]));

        $languageData->addChild($this->getElement('rich_text_editor', [
            'name'  => 'defaultComment',
            'label' => $this->trans('order_status.label.default_comment')
        ]));

        $form->addFilter($this->getFilter('trim'));
        $form->addFilter($this->getFilter('secure'));
    }
}
