/*
 * @Description: 各级菜单功能区实现
 * @Author: Tianjie
 * @LastEditors: Please set LastEditors
 * @Date: 2019-04-08 14:51:15
 * @LastEditTime: 2019-04-09 16:42:33
 */

$(function(){
  //----------------------------------图片菜单导航切换
  $(".common_mid_box .common_mid_items").on("click",function(){
    let index = $(".common_mid_box .common_mid_items").index(this)
    let url = $(this).find('img').attr("src")
    let x = $(".common_bot .common").length

    // 开始判断是否含有checked以选择的图片字符
    if(url.indexOf("checked") < 0 ) {
      let checkedUrl = url.substring(0,url.length-4)+'checked.png'
      $(this).find('img').attr("src",checkedUrl)
    }else{
      $(this).find('img').attr("src",url) 
    }
    
    // 判断兄弟节点的图片属性是否包含checked字段，有则删除，
    $(this).siblings().each(function () {
      let Imgs = $(this).find("img").attr("src")
      if(typeof(Imgs) == "undefined"){
        return
      }else{
        if(Imgs.indexOf("checked") >= 0){
          let newImgs = Imgs.replace('checked','');
          $(this).find("img").attr("src",newImgs);
        }
      }

    })
   
    // 底部功能区内容切换
    for(let i=0;i<x;i++){
			if(index==i){
        $(".common_bot .common").eq(i).addClass('common_active');
        $(".common_bot .common").eq(i).siblings().removeClass('common_active');
      }
		}
  })


  //----------------------------------echarts菜单切换
  $(".echarts_menu p").on("click",function(){
    let index = $(".echarts_menu p").index(this);
    $(this).addClass("menu_active")
    $(this).siblings().removeClass("menu_active")
    if( index == 0 ){
      $(".echart_cont .line").addClass("active")
      $(".echart_cont .pie").removeClass("active")
    }else{
      $(".echart_cont .line").removeClass("active")
      $(".echart_cont .pie").addClass("active")
    }
  })

  //----------------------------------左右展开模块
  $(".right_menu").on("click",function(){
    $(this).hide()
    $(".right_menu_cont").stop().animate({
        width: "74.5vw"
    })
    $(".right_menu_cont").css("border-left","2px solid #F6F6F6")
    $(".left_menu").show();
  });
  $(".left_menu").on("click",function(){
    $(this).hide()
    $(".right_menu_cont").stop().animate({
        width: "0"
    })
    $(".right_menu_cont").css("border","none")
    $(".right_menu").show();
  });
})
