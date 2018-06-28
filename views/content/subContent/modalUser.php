<div class="modal fade" tabindex="-1" role="dialog" id="modal-create-token">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Create a new user and send an invite</h4>
      </div>
      <div class="modal-body">
        <?php echo CHtml::beginForm($addUser['action'],'post',array('class'=>'form-horizontal')); ?>
            <div id="create-token-errors"></div>
            <fieldset>
                <legend>User attribute</legend>
                <ul class='list-unstyled'>
                    <li class="form-group"><?php echo CHtml::label(gT("First name"),'token_firstname',array('class'=>"col-sm-4 control-label")) . CHtml::tag("div",array('class'=>"col-sm-7"),CHtml::textField('token[firstname]','',array('class'=>'form-control'))); ?></li>
                    <li class="form-group"><?php echo CHtml::label(gT("Last name"),'token_lastname',array('class'=>"col-sm-4 control-label")) . CHtml::tag("div",array('class'=>"col-sm-7"),CHtml::textField('token[lastname]','',array('class'=>'form-control'))); ?></li>
                    <li class="form-group"><?php echo CHtml::label(gT("Email"),'token_email',array('class'=>"col-sm-4 control-label")) . CHtml::tag("div",array('class'=>"col-sm-7"),CHtml::emailField('token[email]','',array('class'=>'form-control'))); ?></li>
                    <?php foreach($addUser['attributes'] as $attribute=>$aAttribute) {
                        echo CHtml::tag("li",array('class'=>"form-group"),
                            CHtml::label($aAttribute['caption'],'token_'.$attribute,array('class'=>"col-sm-4 control-label"))
                            . CHtml::tag("div",array('class'=>"col-sm-7"),
                                CHtml::textField('token['.$attribute.']','',array('class'=>'form-control','required'=>($aAttribute['mandatory'] == 'Y')))
                            )
                        );
                    }?>
                    <?php if($addUser["attributeGroup"]) {
                        echo CHtml::tag("li",array('class'=>"form-group"),
                            CHtml::label($addUser["attributeGroup"],'token_'.$addUser["attributeGroup"]["attribute"],array('class'=>"col-sm-4 control-label"))
                            . CHtml::tag("div",array('class'=>"col-sm-7"),
                                CHtml::textField('token['.$addUser["attributeGroup"]["attribute"].']','',array('class'=>'form-control','required'=>($addUser["attributeGroup"]['mandatory'] == 'Y')))
                            )
                        );
                    }?>
                    <?php if($addUser["tokenAttributeGroupManager"]) {
                        echo CHtml::tag("li",array('class'=>"form-group"),
                            CHtml::label($addUser["tokenAttributeGroupManager"],'token_'.$addUser["tokenAttributeGroupManager"]["attribute"],array('class'=>"col-sm-4 control-label"))
                            . CHtml::tag("div",array('class'=>"col-sm-7"),
                                CHtml::checkBox('token['.$addUser["tokenAttributeGroupManager"]["attribute"].']',false,array('class'=>'form-control'))
                            )
                        );
                    }?>
                </ul>
            </fieldset>
            <fieldset>
                <legend>Email to send</legend>
                <ul class='list-unstyled'>
                    <li class="form-group"><?php
                        echo CHtml::label(gT("Subject"),'emailsubject',array('class'=>"col-sm-4 control-label"))
                            . CHtml::tag("div",
                                array('class'=>"col-sm-7"),
                                CHtml::textField('emailsubject',$addUser['email']['subject'],array('class'=>'form-control','data-default'=>$addUser['email']['subject']))
                            );
                    ?></li>
                    <li class="form-group">
                        <?php
                            $textArea = Yii::app()->getController()->widget('yiiwheels.widgets.html5editor.WhHtml5Editor', array(
                                'name' => 'emailbody',
                                'value' => $addUser['email']['body'],
                                'pluginOptions' => array(
                                    'html' => $addUser['email']['html'],
                                    'lists' => false,
                                    'image'=>false,
                                    'link'=>false,
                                ),
                                'htmlOptions' => array(
                                    'class'=> 'form-control',
                                    'data-default'=>$addUser['email']['body'],
                                ),
                            ),true);
                            //$textArea = Chtml::textArea('email[body]',$addUser['email']['body'],array('class'=> 'form-control','data-default'=>$addUser['email']['body']));
                            echo CHtml::label(gT("Body"),'emailbody',array('class'=>"col-sm-4 control-label")) .
                            CHtml::tag("div",array('class'=>"col-sm-7"),
                            $textArea . "<p class='help-block'>".$addUser['email']['help']."</p>");
                        ?>
                    </li>

                </ul>
            </fieldset>
            <div class="form-group">
                <div class="col-sm-offset-4 col-sm-8">
                    <?php echo CHtml::htmlButton("Create and send",array('type'=>'submit','class'=>"btn btn-primary")); ?>
                </div>
            </div>
        <?php echo CHtml::endForm(); ?>
        </div>
      <div class="modal-footer">
        <?php
          echo CHtml::htmlButton($lang['Close'],array('type'=>'button','class'=>"btn btn-warning",'data-dismiss'=>"modal"));
        ?>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->