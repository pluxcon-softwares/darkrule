<div class="row">
    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6">
        <div class="tile-stats sg-shadow" style="background-color: #293A50 ; color:#ffff ;">
          <div class="icon"><i class="fa fa-support"></i>
          </div>
            <div class="count">
                {{ $countAccounts ? $countAccounts : 0 }}
            </div>

          <h3>Accounts</h3>

        </div>
      </div>

      <div class="animated flipInY col-lg-3 col-md-3 col-sm-6">
        <div class="tile-stats sg-shadow" style="background-color: #293A50 ; color:#ffff;">
          <div class="icon"><i class="fa fa-gear"></i>
          </div>
          <div class="count">
                    {{ $countTools ? $countTools : 0 }}
          </div>

          <h3>Tools</h3>

        </div>
      </div>

      <div class="animated flipInY col-lg-3 col-md-3 col-sm-6">
        <div class="tile-stats sg-shadow" style="background-color: #293A50 ; color:#ffff ;">
          <div class="icon"><i class="fa fa-mortar-board"></i>
          </div>
          <div class="count">
            {{ $countTutorials ? $countTutorials : '0' }}
          </div>

          <h3>Tutorials</h3>

        </div>
      </div>

      <div class="animated flipInY col-lg-3 col-md-3 col-sm-6">
        <div class="tile-stats sg-shadow" style="background-color: #293A50 ; color:#ffff ;">
          <div class="icon"><i class="fa fa-bank"></i>
          </div>
          <div class="count">
                {{ $countBankLogs ? $countBankLogs : 0 }}
          </div>

          <h3>Bank Logs</h3>

        </div>
      </div>
</div>
