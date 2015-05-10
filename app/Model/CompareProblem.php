<?php
	class CompareProblem extends AppModel{
		public $name = 'CompareProblem';

    public function similar_problem($question_data){
      // これから700回転くらいします
      foreach($question_data['making'] as $making_row_num => $making_problem){

        // これから300回転くらいします
        $compare_data_num = 0; //compare_data_numの添字
        foreach($question_data['function'] as $function_row_num => $function_problem){
          // 問題文の類似度を演算
          $question_result = similar_text($making_problem['MakingProblem']['question'],
            $function_problem['FunctionProblem']['function_make_question']);
          // 回答の類似度を演算
          $answer_result = similar_text($making_problem['MakingProblem']['answer'],
            $function_problem['FunctionProblem']['function_make_answer']);
          // 加算することで問題としての類似度を演算
          $degrree_similarity = $question_result + $answer_result;

          $compare_data[$compare_data_num]['question_result'] = $question_result;
          $compare_data[$compare_data_num]['answer_result'] = $answer_result;
          $compare_data[$compare_data_num]['degrree_similarity'] = $degrree_similarity;
          // 機能利用問題情報
          $compare_data[$compare_data_num]['function_queston'] = $function_problem['FunctionProblem']['function_make_question'];
          $compare_data[$compare_data_num]['function_answer'] = $function_problem['FunctionProblem']['function_make_answer'];

          // 被験者作問題情報
          $compare_data[$compare_data_num]['making_queston'] = $making_problem['MakingProblem']['question'];
          $compare_data[$compare_data_num]['making_answer'] = $making_problem['MakingProblem']['answer'];

          $sort_key[$compare_data_num] = $compare_data[$compare_data_num]['answer_result'];
          $compare_data_num++;
        }
        // 最大値をひとつだけ抽出してcompare_resultへ格納
        array_multisort($sort_key,SORT_DESC,$compare_data);
        $similar_data[] = $compare_data[0];

      }
      // return $compare_data;
      return $similar_data;
      // return $question_data['making'];
    }

    public function constant_problem($question_data){
      // これから700回転くらいします
      $compare_data_num = 0; //compare_data_numの添字
      foreach($question_data['making'] as $making_row_num => $making_problem){
        // これから300回転くらいします
        foreach($question_data['function'] as $function_row_num => $function_problem){
          $questoin_constant_flg = strcmp($function_problem['FunctionProblem']['function_make_question'],$making_problem['MakingProblem']['question']);
          $answer_constant_flg = strcmp($function_problem['FunctionProblem']['function_make_answer'],$making_problem['MakingProblem']['answer']);
          if($questoin_constant_flg == 0 && $answer_constant_flg == 0 ){
            // 機能利用問題情報
            $compare_data[$compare_data_num]['function_queston'] = $function_problem['FunctionProblem']['function_make_question'];
            $compare_data[$compare_data_num]['function_answer'] = $function_problem['FunctionProblem']['function_make_answer'];


            // 被験者作問題情報
            $compare_data[$compare_data_num]['making_queston'] = $making_problem['MakingProblem']['question'];
            $compare_data[$compare_data_num]['making_answer'] = $making_problem['MakingProblem']['answer'];
            $compare_data[$compare_data_num]['user_id'] = $making_problem['MakingProblem']['user_id'];
            $compare_data[$compare_data_num]['id'] = $making_problem['MakingProblem']['id'];
            $compare_data_num++;
          }

        }

      }
      // return $compare_data;
       return $question_data['function'];
      // return $question_data['making'];
    }



  }
?>
