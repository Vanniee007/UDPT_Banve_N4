package com.udpt_banve.authservice.controller;

import lombok.extern.slf4j.Slf4j;
import org.slf4j.Logger;
import org.slf4j.LoggerFactory;
import org.springframework.security.oauth2.client.authentication.OAuth2AuthenticationToken;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

import java.util.Map;

@RestController
@RequestMapping("/sso")
@Slf4j
public class GGLogin {

//    @GetMapping("/login")
//    public Map<String, Object> login(OAuth2AuthenticationToken token) {
//        log.info("google: {}",token.toString());
//        return token.getPrincipal().getAttributes();
//    }

    @GetMapping("/login")
    public Map<String, Object> login(OAuth2AuthenticationToken token) {
        Map<String, Object> userInfo = token.getPrincipal().getAttributes();

//        GoogleProfile googleUserInfo = new GoogleProfile();
        log.info((String) userInfo.get("sub"));
        log.info((String) userInfo.get("email"));
        log.info((String) userInfo.get("given_name"));
        log.info((String) userInfo.get("family_name"));
        log.info((String) userInfo.get("picture"));
        log.info((String) userInfo.get("exp").toString()); // Lưu expiration time vào entity

        return userInfo;
    }
}
