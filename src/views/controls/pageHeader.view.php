<list:declare name="pageMenu">
    <controls:pageUrl folderUrl="cepage:folder_id.url" type="view">
        <list:add key-iconPrefix="fa" key-icon="eye" key-url="template:pageUrl" key-text="View" />
    </controls:pageUrl>
    <login:authorized any="wiki">
        <controls:pageUrl folderUrl="cepage:folder_id.url" type="edit">
            <list:add key-iconPrefix="fa" key-icon="pen" key-url="template:pageUrl" key-text="Edit" />
        </controls:pageUrl>
        <controls:pageUrl folderUrl="cepage:folder_id.url" type="history">
            <list:add key-iconPrefix="fas" key-icon="history" key-url="template:pageUrl" key-text="History" />
        </controls:pageUrl>
        <controls:pageUrl folderUrl="cepage:folder_id.url" type="files">
            <list:add key-iconPrefix="fa" key-icon="file" key-url="template:pageUrl" key-text="Files" />
        </controls:pageUrl>
        <controls:pageUrl folderUrl="cepage:folder_id.url" type="delete">
            <list:add key-iconPrefix="fa" key-icon="trash-alt" key-url="template:pageUrl" key-text="Delete..." key-class="text-danger" />
        </controls:pageUrl>
    </login:authorized>
</list:declare>

<controls:stickyHeader separator="false">
    <div class="d-flex">
        <div class="flex-fill text-truncate px-2 pb-2 pb-sm-0">
            <h1 class="mb-0 text-truncate">
                <web:out text="cepage:title" />
            </h1>
        </div>
        <div class="dropdown d-sm-none">
            <bs:button color="link" data-toggle="dropdown" class="text-dark">
                <fa5:icon prefix="fas" name="ellipsis-v" />
            </bs:button>
            <div class="dropdown-menu dropdown-menu-right">
                <ui:forEach items="list:pageMenu">
                    <a href="<web:out text="list:pageMenu-url" />" class="dropdown-item <web:out text="list:pageMenu-class" />">
                        <fa5:icon prefix="list:pageMenu-iconPrefix" name="list:pageMenu-icon" />
                        <span>
                            <web:out text="list:pageMenu-text" />
                        </span>
                    </a>
                </ui:forEach>
            </div>
        </div>
    </div>
    <div class="d-block d-sm-flex align-items-end">
        <div class="flex-grow-1 border-bottom pb-2 px-2 d-none d-sm-block">
            <div class="">
                <web:condition when="cepage:folder_id.name">
                    <small class="mr-1">
                        <fa5:icon prefix="fas" name="folder" title="Folder" />
                        <web:out text="cepage:folder_id.name" />
                    </small>
                </web:condition>
                <small class="mr-1">
                    <fa5:icon prefix="far" name="clock" title="Changed at" />
                    <ui:dateTimeValue value="cepage:changed_date" format="d.m.Y H:i:s" />
                </small>
                <web:condition when="cepage:is_public">
                    <small class="mr-1">
                        <fa5:icon name="user-secret" />
                        Public
                    </small>
                </web:condition>
            </div>
        </div>
        <div class="d-none d-sm-block">
            <bs:nav mode="tabs">
                <ui:forEach items="list:pageMenu">
                    <bs:navItem url="list:pageMenu-url" a-class="list:pageMenu-class">
                        <fa5:icon prefix="list:pageMenu-iconPrefix" name="list:pageMenu-icon" />
                        <span class="d-none d-md-inline">
                            <web:out text="list:pageMenu-text" />
                        </span>
                    </bs:navItem>
                </ui:forEach>
            </bs:nav>
        </div>
    </div>
</controls:stickyHeader>