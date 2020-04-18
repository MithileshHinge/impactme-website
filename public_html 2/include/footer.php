<footer class="col-md-12 landing-footer">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <p class="copy-right">Contact us: <a href="mailto:<?=$sql_web->email_id?>"><?=$sql_web->email_id?></a></p>
              <p class="copy-right"> <a href="<?=BASEPATH?>/terms-conditions/">Terms & Conditions</a></p>
            <hr style="margin-bottom: 6px;margin-top: 20px;border: 1px solid #e2e0e0;width: 46%;" align="center">
            <p class="address"><?=$sql_web->address?> <?=$sql_web->address1?><br>
            <div class="copy-right"><?=html_entity_decode($sql_web->copyright)?></div>
        </div>
        <div class="col-md-4"></div>
        
    </footer>