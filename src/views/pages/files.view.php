<filter:declare name="detail" alias="p">
    <filter:equals name="url" value="template:url" />
    <login:authorized none="wiki">
        <filter:equals name="is_public" value="1" />
    </login:authorized>
</filter:declare>
<cepage:list filter="filter:detail">
    <ui:first items="cepage:list">
        <cepage:register name="url" />
        <template:title value="cepage:title" />
        <div class="d-flex align-items-center">
            <div class="flex-grow-1 text-truncate">
                <h1 class="mb-0 text-truncate">
                    Attached files
                </h1>
            </div>
            <login:authorized any="wiki">
                <div>
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
            <div class="ml-2">
                <controls:pageLink folderUrl="cepage:folder_id.url" class="btn btn-secondary text-nowrap">
                    View page
                </controls:pageLink>
            </div>
        </div>
        <div class="mt-4">
            <fa:browser dirId="cepage:directory_id">
                <ui:grid items="fa:browserList" class="table">
                    <ui:column header="Id" value="fa:browserId" />
                    <ui:columnTemplate header="Name">
                        <utils:concat output="var:fileName" separator="." value1="fa:browserName" value2="fa:browserExtension" />
                        <web:out text="var:fileName" />
                    </ui:columnTemplate>
                    <ui:columnDateTime header="Modified" value="fa:timestamp" format="d.m.Y H:i:s" />
                    <ui:columnTemplate header="Link">
                        &#126;/file.php?rid=<web:out text="fa:browserId" />
                    </ui:columnTemplate>
                    <ui:columnTemplate>
                        <a href="~/file.php?rid=<web:out text="fa:browserId" />" target="_blank">
                            Open...
                        </a>
                    </ui:columnTemplate>
                </ui:grid>
            </fa:browser>
        </div>
    </ui:first>
</cepage:list>

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