<?php

            if(1==2){
                echo "
                    <div style='font-size: 20px;
                    text-align:center;width:80%;padding:40px;background-color:#212838; color:white; margin: auto;'>
                    No answer available
                    </div>
            ";
            }else{
            echo "<div class='answer-section'>
            <div class='answer-child'>
            <h1>is called theory of relativity.</h1>
             <div class ='like-section'>
            <h3 class='liked' id='liked'>$liked</h3>
            <i class='far fa-thumbs-up fa-2x' id='like' onclick='go()'></i>
   </div>
    </div>
    <div class='answer-childs'>
    <input type='submit' class='satisfied' id='satisfied' value='Satisfied' onclick='goo()'>
    <span class='span' id='span'></span>
    </div>
    <form action='' method='POST' style='margin-left: 30px;'>
                        <input type='hidden' name='post_id' value=''/> 
                        <button type = 'submit' class='btn btn-lg btn-success' name='like'><i class='fa fa-thumbs-o-up'></i>Like</button>
                    </form>
    </div>";
    }
        ?>

    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>

        function myTrim(x) {
      return x.replace(/^\s+|\s+$/gm,'');
    }

    $(document).ready(function(){

      $('.button_post_answer').on('click',function(){

                var str = $('#question').text();
                var question = myTrim(str);

          location.replace(http://localhost:80/merge2/Merge/unsolved_answer_input/unsolved_ask.php? ques=${question})

      });
    });

        const like  = document.getElementById('like');
        const satisfied  = document.getElementById('satisfied');
        
        function go() {
            let data2 = "<?php echo $liked ?>";
            let data = like.className == 'fas fa-thumbs-up fa-2x';
            if(data)
            {
                like.className = 'far fa-thumbs-up fa-2x';
                data2 = parseInt(data2) - 0;
                document.getElementById('liked').innerHTML = data2;
            }
            else{
                like.className = 'fas fa-thumbs-up fa-2x';
                      data2 = parseInt(data2) + 1;
                document.getElementById('liked').innerHTML = data2;
                
               "<?php
                            
                                
                         $sql = "UPDATE solved set liked = 8 where question_name = 'what is theory of relativity'";
                            $result=mysql_query($sql);
                            
                            
                                ?>";
                
            }
            
        } 
        const goo = () => {
            let data = satisfied.style.backgroundColor == 'lime';
            if(data)
                {
                    satisfied.style.backgroundColor = 'lightgray';
                }
            else
                {
                    satisfied.style.backgroundColor = 'lime';
                    const span = document.getElementById('span').innerHTML = 'Thanks for your response';
                    setTimeout(function() {
                      const span = document.getElementById('span').innerHTML = '';  
                    }, 2000);
                }
        }
  </script>

</body>
</html>