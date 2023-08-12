<controls:pageDetail url="template:url">
    <cehistory:list filter-id="cepage:id" filter-created_date="template:createdDate">
        <ui:first items="cehistory:list">
            <h3 class="text-truncate">
                Revision from <ui:dateTimeValue value="cehistory:created_date" format="d.m.Y H:i:s" />
            </h3>

            <edit:form submit="sadkjalskdjalskdj">
                <ui:editable is="false">
                    <cehistory:form key-id="cepage:id" key-created_date="template:createdDate">
                        <bs:row>
                            <bs:column default="12" medium="6">
                                <bs:formGroup label="Title:" field="title">
                                    <ui:textbox name="title" class="bs:fieldValidatorCssClass" tabindex="1" autofocus="autofocus" />
                                </bs:formGroup>
                            </bs:column>
                            <bs:column default="12" medium="6">
                                <bs:formGroup label="Url:" field="url">
                                    <ui:textbox name="url" class="bs:fieldValidatorCssClass" tabindex="2" />
                                </bs:formGroup>
                            </bs:column>
                            <bs:column default="12">
                                <div class="form-check-inline">
                                    <ui:checkbox name="is_public" class="form-check-input" id="cbx-public" />
                                    <label class="form-check-label" for="cbx-public">
                                        Publicly accessible
                                    </label>
                                </div>
                                <div class="form-check-inline">
                                    <ui:checkbox name="is_archived" class="form-check-input" id="cbx-archived" />
                                    <label class="form-check-label" for="cbx-archived">
                                        Archived
                                    </label>
                                </div>
                            </bs:column>
                        </bs:row>
                        <bs:formGroup field="content" class="mt-3">
                            <ui:textarea id="md-content" name="content" class="bs:fieldValidatorCssClass" style="height:500px;" tabindex="3" />
                        </bs:formGroup>
                    </cehistory:form>
                </ui:editable>
            </edit:form>
        </ui:first>
    </cehistory:list>
</controls:pageDetail>