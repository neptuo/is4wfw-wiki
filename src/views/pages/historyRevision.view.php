<filter:declare name="detail" alias="p">
    <filter:equals name="url" value="template:url" />
    <login:authorized none="wiki">
        <filter:equals name="is_public" value="1" />
    </login:authorized>
</filter:declare>
<ce:list name="page" filter="filter:detail">
    <ui:empty items="ce:list">
        Not found
    </ui:empty>
    <ui:first items="ce:list">
        <cehistory:list name="pagehistory" filter-id="ce:id" filter-created_date="template:createdDate">
            <ui:first items="cehistory:list">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1 text-truncate">
                        <h1 class="mb-0 text-truncate">
                            Revision from <ui:dateTimeValue value="cehistory:created_date" format="d.m.Y H:i:s" />
                        </h1>
                    </div>
                    <div>
                        <web:a pageId="route:page" class="btn btn-primary text-nowrap">
                            View current
                        </web:a>
                    </div>
                    <div class="ml-2">
                        <web:a pageId="route:history" class="btn btn-secondary text-nowrap">
                            <fa5:icon prefix="fas" name="history" />
                            <span class="d-none d-md-inline">
                                History
                            </span>
                        </web:a>
                    </div>
                </div>
                <hr>

                <edit:form submit="sadkjalskdjalskdj">
                    <ui:editable is="false">
                        <cehistory:form name="pagehistory" key-id="ce:id" key-created_date="template:createdDate">
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
                                    <div class="form-check">
                                        <ui:checkbox name="is_public" class="form-check-input" id="cbx-public" />
                                        <label class="form-check-label" for="cbx-public">
                                            Publicly accessible
                                        </label>
                                    </div>
                                </bs:column>
                            </bs:row>
                            <bs:formGroup label="Content:" field="content">
                                <ui:textarea id="md-content" name="content" class="bs:fieldValidatorCssClass" style="height:500px;" tabindex="3" />
                            </bs:formGroup>
                        </cehistory:form>
                    </ui:editable>
                </edit:form>
            </ui:first>
        </cehistory:list>
    </ui:first>
</ce:list>