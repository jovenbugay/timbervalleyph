<div class="modal fade bd-example-modal-lg-<?php echo $row['order_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">#<?php echo $row['order_id']; ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        ...
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                      </div>
                    </div>
                  </div>
                </div>
              
              
                <?php }?>
              </tbody>
                  <tfoot>
                  <tr>
                  <th>Order #</th>
                  <th>Name</th>
                  
                  <th>Contact</th>
                  <th>Status</th>
                
                </tr>
                  </tfoot>