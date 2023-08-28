<controls:pageDetail url="template:url" includeDirectoryId="true">
        <web:out if:stringEmpty="cepage:directory_id" if:not="true">
            <div>
                <fa:browser dirId="cepage:directory_id">
                    <ui:empty items="fa:browserList">
                        <bs:alert color="warning">
                            No attached files for this page
                        </bs:alert>
                    </ui:empty>
                    <ui:grid items="fa:browserList" class="table table-hover" thead-class="bg-dark text-light">
                        <ui:columnTemplate header="Name">
                            <utils:concat output="var:fileName" separator="." value1="fa:browserName" value2="fa:browserExtension" />
                            <web:out text="var:fileName" />
                        </ui:columnTemplate>
                        <ui:columnDateTime header="Modified" value="fa:timestamp" format="d.m.Y H:i:s" />
                        <login:authorized any="wiki">
                            <ui:columnTemplate header="Link">
                                &#126;/file.php?rid=<web:out text="fa:browserId" />
                            </ui:columnTemplate>
                        </login:authorized>
                        <ui:columnTemplate td-style="width:1%">
                            <a href="~/file.php?rid=<web:out text="fa:browserId" />" target="_blank">
                                Open...
                            </a>
                        </ui:columnTemplate>
                    </ui:grid>
                </fa:browser>
            </div>
            <login:authorized any="wiki">
                <div class="mt-4">
                    <edit:form submit="upload">
                        <web:out if:true="edit:saved">
                            <web:redirectToSelf />
                        </web:out>

                        <div style="display: none;">
                            <fa:upload dirId="cepage:directory_id">
                                <ui:filebox id="upload-box" name="files" isMulti="true" />
                            </fa:upload>
                            <button id="upload-submit" type="submit" name="upload" value="upload"></button>
                        </div>
                        <bs:button id="upload-button" color="primary" type="button">
                            Upload...
                        </bs:button>
                    </edit:form>
                </div>
            </login:authorized>
        </web:out>
        <bs:alert color="warning" if:stringEmpty="cepage:directory_id">
            Save the page before uploading files
        </bs:alert>
</controls:pageDetail>

<js:script placement="tail">
	$uploadSubmit = $("#upload-submit");
    $uploadBox = $("#upload-box");
    $uploadBox.change(() => {
        $uploadSubmit.click();
    });
    $("#upload-button").click(e => {
        e.preventDefault();
        $uploadBox.click();
    });
</js:script>