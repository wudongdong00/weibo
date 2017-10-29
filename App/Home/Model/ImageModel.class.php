<?php
namespace Home\Model;

use Think\Model;
use Think\Image;
use Think\Upload;
class ImageModel extends Model{
    public function SaveImg($img,$pic){

        foreach ($img as $key=> $value){
            $data=array(
                'data'=>$value,
                'tid'=>$pic,
            );
            if(! $this->add($data)){
                return 0;
            }
        }
        return 1;
    }

    public function image(){
        $upload =new Upload();
        $upload->rootPath=C('UPLOAD_PATH');
        $info=$upload->upload();
        if($info){
            $savePath = $info['Filedata']['savepath'];
            $saveName = $info['Filedata']['savename'];
            $imgPath=C('UPLOAD_PATH').$savePath.$saveName;
            $img=new Image();
            $img->open($imgPath);
            $thunmbPath=C('UPLOAD_PATH').$savePath.'180_'.$saveName;
            $img->thumb(180,180)->save($thunmbPath);
            $img->open($imgPath);
            $unfoldPath=C('UPLOAD_PATH').$savePath.'550_'.$saveName;
            $img->thumb(550,550)->save($unfoldPath);
            $imaArr = array(
                'thumb'=>$thunmbPath,
                'unfold'=>$unfoldPath,
                'source'=>$imgPath,
            );
            return $imaArr;
        }else{
            return $upload->getError();
        }
    }

    public function face(){
        $Upload = new Upload();
        $Upload->rootPath = C('UPLOAD_PATH');
        $info = $Upload->upload();
        if ($info) {
            $savePath = $info['Filedata']['savepath'];
            $saveName = $info['Filedata']['savename'];
            $imgPath = C('UPLOAD_PATH').$savePath.$saveName;
            $image = new Image();
            $image->open($imgPath);
            $image->thumb(500, 500)->save($imgPath);
            return $imgPath;
        } else {
            return $Upload->getError();
        }
    }

    public function savePic($x,$y,$w,$h,$url){
        $bigFace=C('FACE_PATH').session('user_auth')['id'].'.jpg';
        $smallFace=C('FACE_PATH').session('user_auth')['id'].'_small.jpg';
        $image=new Image();
        $image->open($url);
        $image->crop($w,$h,$x,$y)->save($url);
        $image->thumb(200, 200, Image::IMAGE_THUMB_FIXED)->save($bigFace);
        $image->thumb(50, 50, Image::IMAGE_THUMB_FIXED)->save($smallFace);
        $imageArr = array(
            'big'=>$bigFace,
            'small'=>$smallFace,
        );
        return  $imageArr;
    }
}