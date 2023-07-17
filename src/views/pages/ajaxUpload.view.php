<cepage:list filter-url="cepage:url">
    <ui:first items="cepage:list">
        <var:declare name="dirId" value="cepage:directory_id" />
    </ui:first>
</cepage:list>

<edit:execute>
    <web:out if:true="edit:saved">
        <utils:concat output="var:uploadFileId" separator="," value1="fa:uploadFileId" />
        <fileUrl:declare name="uploadFile" id="var:uploadFileId" />
    </web:out>

    <fa:upload dirId="var:dirId">
        <ui:filebox name="file" />
    </fa:upload>
</edit:execute>

<web:out if:stringEmpty="fileUrl:uploadFile" if:not="true">
    <json:output>
        <json:object>
            <json:key name="url" value="fileUrl:uploadFile" />
        </json:object>
    </json:output>
</web:out>