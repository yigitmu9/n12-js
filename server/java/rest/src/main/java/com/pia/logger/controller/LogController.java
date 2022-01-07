package com.pia.logger.controller;

import java.util.Date;
import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.boot.autoconfigure.EnableAutoConfiguration;
import org.springframework.http.MediaType;
import org.springframework.web.bind.annotation.CrossOrigin;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestMethod;
import org.springframework.web.bind.annotation.RestController;

import com.pia.logger.model.Log;
import com.pia.logger.repository.LogRepository;

@CrossOrigin
@RestController
@EnableAutoConfiguration
@RequestMapping("/log")
public class LogController {
	
	@Autowired
	LogRepository repository;

    @RequestMapping(method = RequestMethod.GET)
    public List<Log> getGreetingList() {
        return repository.findAll();
    }
    
    @RequestMapping(value = "/{id}", method = RequestMethod.GET)
    public Log getGreeting(@PathVariable("id") String id) {
        return repository.getOne(id);
    }
    
    @RequestMapping(value = "/{id}", method = RequestMethod.PUT, 
    		consumes = MediaType.APPLICATION_JSON_VALUE, 
    		produces = MediaType.APPLICATION_JSON_VALUE)
    public Log updateGreeting(@PathVariable("id") String id, @RequestBody Log log) {
    	log.setId(id);
        return repository.save(log);
    }
    
    @RequestMapping(method = RequestMethod.POST, 
    		consumes = MediaType.APPLICATION_JSON_VALUE, 
    		produces = MediaType.APPLICATION_JSON_VALUE)
    public Log createGreeting(@RequestBody Log log) {
    	if (log.getId() == null || log.getId() == "") {
    		log.setId(Long.toHexString((Double.doubleToLongBits(Math.random()))) + "_" + new Date().getTime());
    	}
    	
        return repository.save(log);
    }
    
    @RequestMapping(value = "/{id}", method = RequestMethod.DELETE)
    public boolean deleteGreeting(@PathVariable("id") String id) {
    	Log log = new Log();
    	log.setId(id);
        repository.delete(log);
        return true;
    }
}
