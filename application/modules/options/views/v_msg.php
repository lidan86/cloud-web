<?php // if (!$get_msg == ''){?>
    <div class="modal" id="modal_default_11" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Messages</h4>
                </div>                
                <div class="modal-body clearfix np">                    
                    <div class="list list-contacts">
                    <?php foreach($get_msg as $isi){ ?>
                        <a href="#" class="list-item">                                
                            <div class="list-info">
                                <img src="img/example/user/dmitry_s.jpg" class="img-circle img-thumbnail">
                            </div>                                                            
                            <div class="list-text">
                                <span class="list-text-name">John Doe</span>
                                <div class="list-text-info"><i class="icon-info"></i> Some text information</div>
                            </div>
                            <div class="list-status list-status-online"></div>
                        </a>
                    <?php } ?>
                    </div>                    
                </div>
                <div class="modal-footer">                    
                    <button type="button" class="btn btn-default btn-clean" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>    
<?php // } ?>

<div class="modal" id="modal_default_11" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Contacts</h4>
                </div>                
                <div class="modal-body clearfix np">
                    
                    <div class="list list-contacts">                                
                        <a href="#" class="list-item">                                
                            <div class="list-info">
                                <img src="img/example/user/dmitry_s.jpg" class="img-circle img-thumbnail">
                            </div>                                                            
                            <div class="list-text">
                                <span class="list-text-name">John Doe</span>
                                <div class="list-text-info"><i class="icon-info"></i> Some text information</div>
                            </div>
                            <div class="list-status list-status-online"></div>
                        </a>
                        <a href="#" class="list-item">  
                            <div class="list-info">
                                <img src="img/example/user/alexey_s.jpg" class="img-circle img-thumbnail">
                            </div>
                            <div class="list-text">
                                <span class="list-text-name">Brad Pitt</span>
                                <div class="list-text-info"><i class="icon-info"></i> Some text information</div>
                            </div>                                            
                            <div class="list-status list-status-online"></div>
                        </a>                            
                        <a href="#" class="list-item">
                            <div class="list-info">
                                <img src="img/example/user/olga_s.jpg" class="img-circle img-thumbnail">
                            </div>
                            <div class="list-text">
                                <span class="list-text-name">Angelina Jolie</span>
                                <div class="list-text-info"><i class="icon-info"></i> Some text information</div>
                            </div>                                            
                            <div class="list-status list-status-offline"></div>
                        </a>                            
                    </div>
                    
                </div>
                <div class="modal-footer">                    
                    <button type="button" class="btn btn-default btn-clean" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>